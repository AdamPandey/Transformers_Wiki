<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of all movies, with optional search and director filtering.
     */
    public function index(Request $request)
    {
        // Retrieve all movies and apply search filters if provided
        $movies = Movie::query();
        $search = $request->input('search');
        $director = $request->input('director');

        // Filter movies based on search criteria
        if ($search) {
            $movies->where('title', 'like', '%' . $search . '%');
        }
        if ($director) {
            $movies->where('director', 'like', '%' . $director . '%');
        }

        // Paginate results to display 6 movies per page
        $movies = $movies->paginate(6);

        return view('movies.index', compact('movies', 'search', 'director'));
    }

    /**
     * Show the form for creating a new movie.
     */
    public function create()
    {
        if(auth()->user()->role !== 'admin'){
            return redirect()->route('movies.index')->with('error','Acess denied.');
        }
        return view('movies.create');
    }

    /**
     * Store a newly created movie in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required',
            'release_date' => 'required|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'director' => 'required'
        ]);

        // Handle the uploaded image file
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/movies'), $imageName);
        }

        // Create a new movie record in the database
        Movie::create([
            'title' => $request->title,
            'release_date' => $request->release_date,
            'image' => $imageName, // Save the image file name
            'director' => $request->director,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Redirect to the index page with a success message
        return to_route('movies.index')->with('success', 'Movie created successfully!');
    }

    /**
     * Display the details of a specific movie.
     */
    public function show(Movie $movie)
    {
        return view('movies.show')->with('movie', $movie);
    }

    /**
     * Show the form for editing an existing movie.
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified movie in the database.
     */
    public function update(Request $request, Movie $movie)
    {
        // Validate the incoming request data for updates
        $request->validate([
            'title' => 'required',
            'release_date' => 'required|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional
            'director' => 'required'
        ]);

        $oldImageName = $movie->image;

        // Handle the uploaded image file if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/movies'), $imageName);

            // Optionally delete the old image file
            if ($oldImageName) {
                Storage::delete(public_path('images/movies/' . $oldImageName));
            }
        } else {
            // Keep the old image name if no new image is uploaded
            $imageName = $oldImageName;
        }

        // Update the movie record with new data
        $movie->update([
            'title' => $request->title,
            'release_date' => $request->release_date,
            'image' => $imageName, // Save the image file name
            'director' => $request->director,
            'updated_at' => now()
        ]);

        return to_route('movies.index')->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified movie from the database.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete(); // Delete the movie record
        return redirect()->route('movies.index'); // Redirect back to the movie index
    }
}
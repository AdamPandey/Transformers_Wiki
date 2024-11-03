<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index',compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required',
            'release_date' => 'required|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'director' => 'required'
        ]);

        // Check if the image is uploaded and handle it
        if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/movies'), $imageName);
        }

        // Create a book record in the database
        Movie::create([
        'title' => $request->title,
        'release_date' => $request->release_date,
        'image' => $imageName, // Store the image URL in the DB
        'director' => $request->director,
        'created_at' => now(),
        'updated_at' => now()
        ]);

        // Redirect to the index page with a success message
        return to_route('movies.index')->with('success', 'Movie created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movies.show')->with('movie', $movie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required',
            'release_date' => 'required|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make image optional
            'director' => 'required'
        ]);

        $oldImageName = $movie->image;

        if ($request->hasFile('image')) {
            // Generate a new image name
            $imageName = time() . '.' . $request->image->extension();
            // Move the new image to the public directory
            $request->image->move(public_path('images/movies'), $imageName);

            // Optionally delete the old image
            if ($oldImageName) {
                Storage::delete(public_path('images/movies/' . $oldImageName));
            }
        } else {
            // If no new image is uploaded, keep the old image name
            $imageName = $oldImageName;
        }

        $movie->update([
            'title' => $request->title,
            'release_date' => $request->release_date,
            'image' => $imageName, // Store the image URL in the DB
            'director' => $request->director,
            'updated_at' => now()
        ]);

        return to_route('movies.index')->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
 
        return redirect()->route('movies.index');
    }
}

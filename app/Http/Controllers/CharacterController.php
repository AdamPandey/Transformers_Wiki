<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Character;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::with('movies')->get(); // Fetch all characters
        return view('characters.index', compact('characters')); // Pass characters to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $movies = Movie::all();
        return view('characters.create', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'required|max:500',
            'alt_mode' => 'required',
            'personality' => 'required',
            'faction' => 'required',
            'movies' => 'array',
        ]);
    
        // Handle the uploaded image file
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/characters'), $imageName);
            $validated['image'] = $imageName;
        }
    
        // Create a new character record in the database
        $character = Character::create($validated);
    
        // Attach selected movies to the character
        if ($request->has('movies')) {
            $character->movies()->attach($request->movies);
        }
    
        // Redirect to the index page with a success message
        return redirect()->route('characters.index')->with('success', 'Character created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        $character->load('movies');
        return view('characters.show', compact('character'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        // Fetch all movies
        $movies = Movie::all();

        // Get the IDs of the movies that the character is associated with
        $characterMovies = $character->movies->pluck('id')->toArray();

        // Return the edit view with the character, movies, and selected movies
        return view('characters.edit', compact('character', 'movies', 'characterMovies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if provided
            'bio' => 'required|string',
            'alt_mode' => 'required|string',
            'personality' => 'required|string',
            'faction' => 'required|string',
            'movies' => 'array',
        ]);
        if ($request->hasFile('image')) {
            // Handle the uploaded image file
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/characters'), $imageName);
            $validated['image'] = $imageName; // Update the validated array with the new image name
        } else {
            // If no new image is uploaded, keep the existing image name
            $validated['image'] = $character->image; // Retain the existing image
        }

        $character->update($validated);

        if ($request->has('movies')) {
            $character->movies()->sync($request->movies);
        }
        // Redirect back to the index page with a success message
        return redirect()->route('characters.index')->with('success', 'Character updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        $character->movies()->detach();
        // Delete the character
        $character->delete();

        return redirect()->route('characters.index')->with('success', 'Character deleted successfully.');
    }
}

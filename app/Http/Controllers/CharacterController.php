<?php

namespace App\Http\Controllers;

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
        $characters = Character::all(); // Fetch all characters
        return view('characters.index', compact('characters')); // Pass characters to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('characters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'required|max:500',
            'alt_mode' => 'required',
            'personality' => 'required',
            'faction' => 'required'
        ]);

        // Handle the uploaded image file
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/characters'), $imageName);
        }

        // Create a new movie record in the database
        Character::create([
            'name' => $request->name,
            'image' => $imageName,
            'bio' => $request->bio,
            'alt_mode' => $request->alt_mode,
            'personality' => $request->personality,
            'faction' => $request->faction,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Redirect to the index page with a success message
        return to_route('characters.index')->with('success', 'Character created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        return view('characters.show', compact('character'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        return view('characters.edit', compact('character'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if provided
            'bio' => 'required|string',
            'alt_mode' => 'required|string',
            'personality' => 'required|string',
            'faction' => 'required|string',
        ]);

        $oldImageName = $character->image;
    
        // Handle the uploaded image file if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/characters'), $imageName);

            // Optionally delete the old image file
            if ($oldImageName) {
                Storage::delete(public_path('images/characters/' . $oldImageName));
            }
        } else {
            // Keep the old image name if no new image is uploaded
            $imageName = $oldImageName;
        }

        // Update the movie record with new data
        $character->update([
            'name' => $request->name,
            'image' => $imageName,
            'bio' => $request->bio,
            'alt_mode' => $request->alt_mode,
            'personality' => $request->personality,
            'faction' => $request->faction,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return to_route('characters.index')->with('success', 'Character updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        //
    }
}

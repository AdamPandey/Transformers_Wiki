<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Toy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Movie $movie)
    {
        

        $request->validate([
            'type' => 'required|string|min:1|max:20',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'toyline' => 'required|min:1|max:20',
            'issue_date' => 'nullable|max:500',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/toys'), $imageName);
        }

        $movie->toys()->create([
            'type' => $request->input('type'),
            'image' => $imageName,
            'toyline' => $request->input('toyline'),
            'issue_date' => $request->input('issue_date'),
            'movie_id' => $movie->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('movies.show',$movie)->with('success','Toy added succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Toy $toy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toy $toy)
    {
        if (auth()->user()->id != $toy->user_id && auth()->user()->role !== 'admin'){
            return redirect()->route('movies.index')->with('error','Aceess denied.');
        }

        return view('toys.edit',compact('toy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Toy $toy)
    {
        $request->validate([
            'type' => 'required|string|min:1|max:20',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif', // Make image nullable if it's not required
            'toyline' => 'required|min:1|max:20',
            'issue_date' => 'nullable|integer|max:500',
        ], [
            'issue_date.integer' => 'The issue date must be a valid number.', // Custom error message
        ]);
    
        // Update the toy's attributes
        $toy->type = $request->type;
        $toy->toyline = $request->toyline;
        $toy->issue_date = $request->issue_date;
    
        if ($request->hasFile('image')) {
            // Check if the toy already has an image
            if ($toy->image) {
                // Delete the old image
                $oldImagePath = public_path('images/toys/' . $toy->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image
                }
            }
    
            // Store the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/toys'), $imageName);
            $toy->image = $imageName; // Set the new image name
        }
    
        // Save the toy with the updated attributes
        $toy->save();
    
        return redirect()->route('movies.show', $toy->movie_id)
                         ->with('success', 'Toy Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Toy $toy)
    {
        if (auth()->user()->id != $toy->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Access denied.');
        }
        $toy->delete();
        return redirect()->route('movies.show', $toy->movie_id)
                     ->with('success', 'Toy deleted successfully.'); 
    }
}

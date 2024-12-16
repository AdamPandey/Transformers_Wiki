<?php

namespace App\Http\Controllers;

use App\Models\Movie;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Toy $toy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Toy $toy)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

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
        $movies = $movies->paginate(12);

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
        $apiKey = env('TMDB_API_KEY'); // Get your API key from the .env file
        $searchResponse = Http::get("https://api.themoviedb.org/3/search/movie?api_key={$apiKey}&query=" . urlencode($movie->title));
    
        // Log the movie title being searched
        \Log::info('Searching for movie:', ['title' => $movie->title]);
    
        $videos = [];
        $backdrops = [];
        $cast = [];
        $tmdbMovieTitle = '';
        $tmdbMovieId = null;
    
        if ($searchResponse->successful()) {
            $searchResults = $searchResponse->json();
    
            // Log the search results for debugging
            \Log::info('TMDb Search Results:', $searchResults);
    
            // Check if there are results
            if (!empty($searchResults['results'])) {
                // Get the first result (closest match)
                $closestMatch = $searchResults['results'][0];
                $tmdbMovieId = $closestMatch['id'];
                $tmdbMovieTitle = $closestMatch['title'];
    
                // Fetch the movie details using the TMDb movie ID
                $detailsResponse = Http::get("https://api.themoviedb.org/3/movie/{$tmdbMovieId}?api_key={$apiKey}&append_to_response=videos,credits");
    
                if ($detailsResponse->successful()) {
                    $movieData = $detailsResponse->json();
    
                    // Get videos
                    if (isset($movieData['videos']['results'])) {
                        $videos = $movieData['videos']['results'];
                    }
    
                    // Get backdrops
                    if (isset($movieData['backdrop_path'])) {
                        $backdrops[] = "https://image.tmdb.org/t/p/original" . $movieData['backdrop_path'];
                    }
    
                    // Get cast
                    if (isset($movieData['credits']['cast'])) {
                        $cast = $movieData['credits']['cast'];
                    }
                } else {
                    \Log::error('Failed to fetch movie details from TMDb', [
                        'status' => $detailsResponse->status(),
                        'message' => $detailsResponse->body(),
                    ]);
                }
            } else {
                \Log::warning('No search results found for movie', ['title' => $movie->title]);
            }
        } else {
            \Log::error('Failed to search for movie in TMDb', [
                'status' => $searchResponse->status(),
                'message' => $searchResponse->body(),
            ]);
        }
    
        // Load related data
        $movie->load('characters');
        $movie->load('toys.user');
    
        return view('movies.show', compact('movie', 'videos', 'backdrops', 'cast', 'tmdbMovieTitle'));
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
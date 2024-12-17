<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToyController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

// Define a route for the home page that returns the welcome view
Route::get('/', function () {
    return view('welcome');
});

// Define a route for the dashboard page, protected by authentication and verification middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Movie routes for managing movie resources
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index'); // Display a list of movies
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create'); // Show the form to create a new movie
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show'); // Show details for a specific movie
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store'); // Store a new movie in the database
Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit'); // Show the form to edit a specific movie
Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update'); // Update a specific movie in the database
Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy'); // Delete a specific movie from the database


Route::resource('toys',ToyController::class);

Route::post('movies/{movie}/toys',[ToyController::class, 'store'])->name('toys.store');

Route::resource('characters',CharacterController::class)->middleware('auth');

// Protected routes for user profile management, requiring authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Show the profile edit form
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update the user's profile information
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Delete the user's profile
});

// Include additional authentication routes defined in a separate file
require __DIR__.'/auth.php';
<?php
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/movies',[MovieController::class,'index'])->name('movies.index');
Route::get('/movies/create',[MovieController::class,'create'])->name('movies.create');
Route::get('/movies/{movie}',[MovieController::class,'show'])->name('movies.show');
Route::post('/movies',[MovieController::class,'store'])->name('movies.store');
Route::get('/movies/edit',[MovieController::class,'edit'])->name('movies.edit');
Route::get('/movies/destroy',[MovieController::class,'destroy'])->name('movies.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
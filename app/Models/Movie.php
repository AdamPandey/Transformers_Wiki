<?php

namespace App\Models; // Define the namespace for the Movie model

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import HasFactory trait for factory support
use Illuminate\Database\Eloquent\Model; // Import the base Model class

class Movie extends Model // Define the Movie class that extends the base Model class
{
    use HasFactory; // Use the HasFactory trait to enable factory methods for this model

    // Specify which attributes should be mass assignable
    protected $fillable = [
        'title',        
        'release_date', 
        'image',        
        'director',     
        'created_at',   // Timestamp for when the movie record was created
        'updated_at'    // Timestamp for when the movie record was last updated
    ];

    public function toys()
    {
        return $this->hasMany(Toy::class);
    }
}
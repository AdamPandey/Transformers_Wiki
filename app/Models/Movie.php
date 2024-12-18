<?php

namespace App\Models; // Define the namespace for the Movie model

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import HasFactory trait for factory support
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Movie extends Model implements AuditableContract
{
    use HasFactory, Auditable;

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

    public function characters(){
        return $this->belongsToMany(Character::class);
    }
}
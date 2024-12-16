<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toy extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',        
        'image', 
        'toyline',        
        'issue_date',     
        'created_at',   // Timestamp for when the movie record was created
        'updated_at',
        'user_id',    // Timestamp for when the movie record was last updated
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

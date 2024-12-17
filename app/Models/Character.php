<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','bio','alt_mode','personality','faction'];

    public function movies(){
        return $this->belongsToMany(Movie::class);
    }
}

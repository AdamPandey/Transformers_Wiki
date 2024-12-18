<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Character extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $fillable = ['name','image','bio','alt_mode','personality','faction'];

    public function movies(){
        return $this->belongsToMany(Movie::class);
    }
}

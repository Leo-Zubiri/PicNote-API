<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function album(){
        return $this->belongsTo(Album::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
}

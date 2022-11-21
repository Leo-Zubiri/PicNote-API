<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'name',
        'group',
        'grade',
        'start_schedule',
        'end_schedule',
        'daysperweek'
    ];

    public function album(){
        return $this->belongsTo(Album::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
}

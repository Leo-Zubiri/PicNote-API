<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'album_id',
        'image_url',
        'isHomework',
        'dueTo'
    ];

    public function course(){
        return $this->belongsTo(Album::class);
    }
}

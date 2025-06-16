<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable=['title','author','year','genre_id', 'description', 'user_id', 'status'];

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

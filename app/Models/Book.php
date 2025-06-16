<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Book extends Model
{
    use HasFactory;
    use LogsActivity;

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

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function reservedBy()
    {
        return $this->belongsTo(User::class, 'reserved_by');
    }

        public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('book')
            ->logOnly(['title', 'author', 'year', 'status'])
            ->logOnlyDirty() // log only changed fields
            ->setDescriptionForEvent(fn(string $eventName) => "Book was {$eventName}");
    }
}

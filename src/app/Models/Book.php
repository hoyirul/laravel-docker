<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'publisher_id',
        'genre_id',
        'title',
        'publish_date',
        'book_pages',
        'description',
        'rating',
        'price',
        'cover_image',
        'url_cloud',
    ];

    public function author(){
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }

    public function genre(){
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }
}

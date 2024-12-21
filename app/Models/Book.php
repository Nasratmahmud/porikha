<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model {
    use HasFactory;
    protected $guarded = [];
    public function category() {
        return $this->belongsTo( Category::class, 'category_id' );
    }
    function book_favourites(): HasMany {
        return $this->hasMany( BookFavourite::class );
    }
    static function favCount( $bookId ) {
        $book = Book::find( $bookId );
        return $book->book_favourites()->count();
    }
}

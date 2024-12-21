<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model {
    use HasFactory;
    protected $guarded = [];
    public function category() {
        return $this->belongsTo( Category::class, 'category_id' );
    }
    // Method to filter guides by tag
    public static function filterByTag( $tag, $perPage = null ) {
        $tag = trim( $tag );
        $query = Guide::where( 'status', 1 )->where( 'tag', 'like', "%$tag%" )->orWhere( 'tag', 'like', "%$tag,%" )->orWhere( 'tag', 'like', "%,$tag,%" )->orWhere( 'tag', 'like', "%,$tag" )->orWhere( 'tag', $tag )->with( 'category' )->latest();

        if ( $perPage ) {
            return $query->paginate( $perPage );
        } else {
            return $query->get();
        }
    }

    // Method to filter guides by tag
    public static function uniqueTagList() {
        return Guide::distinct()->pluck( 'tag' )->filter()->flatMap( function ( $tags ) {
            return explode( ',', $tags );
        } )->unique()->sort()->values();
    }
}

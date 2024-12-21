<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bundle extends Model {
    use HasFactory;
    protected $guarded = [];
    public function bundle_items() {
        return $this->hasMany( BundleItem::class );
    }
    function bundle_favourites(): HasMany {
        return $this->hasMany( BundleFavourite::class );
    }
    static function favCount( $bundleId ) {
        $bundle = Bundle::find( $bundleId );
        return $bundle->bundle_favourites()->count();
    }
}

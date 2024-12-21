<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleItem extends Model {
    use HasFactory;
    protected $guarded = [];
    public function bundle() {
        return $this->belongsTo( Bundle::class, 'bundle_id' );
    }
    public function journal() {
        return $this->belongsTo( Journal::class, 'journal_id' );
    }
    public function course() {
        return $this->belongsTo( Course::class, 'course_id' );
    }
    public function book() {
        return $this->belongsTo( Book::class, 'book_id' );
    }
}

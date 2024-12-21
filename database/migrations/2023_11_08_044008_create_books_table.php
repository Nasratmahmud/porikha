<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'books', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'book_name' );
            $table->string( 'book_slug' );
            $table->string( 'book_author' )->nullable();
            $table->date( 'publish_date' );
            $table->longText( 'book_summary' );
            $table->foreignId( 'category_id' )->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->string( 'tag' );
            $table->string( 'feature_image' );
            $table->string( 'file' );
            $table->enum( 'status', [0, 1] )->default( 1 )->comment( '0 = De-Active, 1 = Active' );
            $table->timestamp( 'created_at' )->useCurrent();
            $table->timestamp( 'updated_at' )->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'books' );
    }
};

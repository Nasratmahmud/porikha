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
        Schema::create( 'bundle_items', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'bundle_id' )->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->string( 'title' );
            $table->text( 'sub_description' )->nullable();
            $table->longText( 'description' )->nullable();
            $table->enum( 'type', [1, 2, 3, 4] )->default( 4 )->comment( '1 = Journal, 2 = Course, 3 = Book, 4 = Content' );
            $table->unsignedBigInteger( 'journal_id' )->nullable();
            $table->unsignedBigInteger( 'course_id' )->nullable();
            $table->unsignedBigInteger( 'book_id' )->nullable();
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
        Schema::dropIfExists( 'bundle_items' );
    }
};

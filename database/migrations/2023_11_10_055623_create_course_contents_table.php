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
        Schema::create( 'course_contents', function ( Blueprint $table ) {
            $table->id();
            $table->longText( 'content_title' );
            $table->string( 'video_file' );
            $table->longText( 'content_length' );
            $table->foreignId( 'course_id' )->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId( 'course_module_id' )->constrained()->restrictOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists( 'course_contents' );
    }
};

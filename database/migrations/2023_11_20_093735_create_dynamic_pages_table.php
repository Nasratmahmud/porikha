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
        Schema::create( 'dynamic_pages', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'page_title' );
            $table->string( 'page_slug' )->nullable();
            $table->longText( 'page_content' )->nullable();
            $table->tinyInteger( 'status' )->default( 1 )->comment( '1 = Active / 0 = Deactivate' );
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
        Schema::dropIfExists( 'dynamic_pages' );
    }
};

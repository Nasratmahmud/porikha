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
        Schema::create( 'guides', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'guide_name' );
            $table->string( 'guide_slug' );
            $table->longText( 'guide_description' );
            $table->foreignId( 'category_id' )->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->string( 'tag' );
            $table->enum( 'status', [0, 1] )->default( 1 )->comment( '0 = De-Active, 1 = Active' );
            $table->string( 'feature_image' );
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
        Schema::dropIfExists( 'guides' );
    }
};

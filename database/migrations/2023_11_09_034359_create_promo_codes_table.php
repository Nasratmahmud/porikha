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
        Schema::create( 'promo_codes', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'promo_code_title', 250 );
            $table->string( 'promo_code_slug' );
            $table->string( 'promo_code', 250 )->unique();
            $table->date( 'start_date' );
            $table->date( 'end_date' );
            $table->integer( 'discount_percentage' );
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
        Schema::dropIfExists( 'promo_codes' );
    }
};

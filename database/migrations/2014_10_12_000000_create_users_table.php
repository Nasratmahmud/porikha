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
        Schema::create( 'users', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'username' );
            $table->string( 'name' );
            $table->string( 'email' )->unique();
            $table->string( 'phone_number' )->nullable();
            $table->timestamp( 'email_verified_at' )->nullable();
            $table->string( 'user_avatar' )->nullable();
            $table->string( 'cover_image' )->nullable();
            $table->string( 'password' );
            $table->enum( 'user_type', ['1', '2'] )->default( 2 )->comment( 'Management = 1 | User = 2' );
            $table->string('otp')->nullable();
            $table->timestamp('otp_created_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'users' );
    }
};

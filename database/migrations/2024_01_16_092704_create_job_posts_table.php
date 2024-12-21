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
        Schema::create( 'job_posts', function ( Blueprint $table ) {
            $table->id();

            $table->string( 'title' );
            $table->string( 'slug' );
            $table->longText( 'description' );
            $table->string( 'short_description' );
            $table->date( 'deadline' );
            $table->integer( 'vacancy' );
            $table->enum( 'type', [1, 2,3,4,5,6] )->comment( ' 1=Full-Time,2=Part-time, 3=Contract, 4=Internships, 5=Temporary,Remote' )->default( 1 );
            $table->string( 'position' );
            $table->string( 'selary_range' );
            $table->enum( 'status', [1, 2, 3] )->default( 1 )->comment('1=Pending, 2=Approve, 3=Rejected');
            $table->bigInteger('views')->default(0);

            $table->foreignId( 'user_id' )->constrained()->onDelete( 'cascade' );
            $table->softDeletes();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'job_posts' );
    }
};

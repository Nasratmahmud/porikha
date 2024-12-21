<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_post_facilities', function (Blueprint $table) {
            $table->id();

            $table->foreignId( 'job_post_id' )
                ->constrained()
                ->onDelete( 'cascade' )
                ->cascadeOnUpdate();
            $table->string('facility');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_post_facilities');
    }
};

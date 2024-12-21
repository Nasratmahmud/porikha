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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('job_post_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('expected_salary');
            $table->text('cover_letter');
            $table->string('resume');
            $table->string('experience');
            $table->string('present_address');
            $table->enum('status', [1, 2, 3])->default('1')->comment('1=Pending, 2 = Shortlisted, 3 = Rejected');

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
        Schema::dropIfExists('job_applications');
    }
};

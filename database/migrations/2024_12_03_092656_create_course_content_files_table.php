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
        Schema::create('course_content_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_content_id')->references('id')->on('course_contents')->onDelete('cascade');
            $table->string('file_path');  // File path for PDF, Excel, etc.
            $table->string('file_type');  // File type (pdf, excel, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_content_files');
    }
};

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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // References users table
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // References courses table
            $table->string('transaction_id'); // Stripe transaction ID
            $table->decimal('amount', 10, 2); // Amount paid
            $table->string('currency', 10); // Currency code (e.g., USD)
            $table->string('status')->default('pending'); // Status of the payment
            $table->string('receipt_url')->nullable(); // Optional receipt URL
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
        Schema::dropIfExists('purchases');
    }
};

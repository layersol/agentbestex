<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // id
            $table->unsignedBigInteger('user_id'); // foreign key to users
            $table->string('trx_id')->unique(); // transaction ID
            $table->string('type'); // type of transaction (e.g., credit, debit)
            $table->dateTime('date'); // transaction date
            $table->string('payment_gateway')->nullable(); // payment gateway used
            $table->decimal('amount', 15, 2); // transaction amount
            $table->string('currency', 10)->default('USD'); // currency
            $table->text('description')->nullable(); // optional description
            $table->string('attachment')->nullable(); // attachment path
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // status
            $table->timestamps();

            // Optional: add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
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
        Schema::create('airlines', function (Blueprint $table) {
            $table->id(); // id
            $table->string('name'); // airline name
            $table->string('code')->nullable(); // airline code
            $table->string('iata', 3)->nullable(); // IATA code (3 letters)
            $table->string('sign')->nullable(); // airline sign/logo code
            $table->string('country')->nullable(); // country
            $table->enum('status', ['active', 'inactive'])->default('active'); // status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airlines');
    }
};
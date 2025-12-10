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
         Schema::create('flights_airports', function (Blueprint $table) {
            $table->id(); // id
            $table->string('airport'); // airport name
            $table->string('city')->nullable(); // city
            $table->string('country')->nullable(); // country
            $table->string('code', 10)->nullable(); // airport code
            $table->decimal('late', 10, 6)->nullable(); // latitude
            $table->decimal('long', 10, 6)->nullable(); // longitude
            $table->string('region')->nullable(); // region
            $table->string('type')->nullable(); // type (e.g., international/domestic)
            $table->enum('status', ['active', 'inactive'])->default('active'); // status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights_airports');
    }
};

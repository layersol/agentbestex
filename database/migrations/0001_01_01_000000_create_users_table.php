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
   
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // parent or referring user
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_code')->nullable();
            $table->string('password');
            $table->boolean('status')->default(1);

            // Contact details
            $table->string('phone_country_code')->nullable();
            $table->string('phone')->nullable();

            // Company / agency details
            $table->string('company_name')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->decimal('company_commission', 10, 2)->nullable();
            $table->text('note')->nullable();

            // Location info
            $table->string('country_code')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();

            // Financial info
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->decimal('balance', 15, 2)->default(0);

            // User type and agency info
            $table->string('user_type')->nullable();
            $table->string('agency_name')->nullable();
            $table->string('agency_license')->nullable();
            $table->string('agency_logo')->nullable();
            $table->decimal('markup_hotels', 8, 2)->default(0);
            $table->decimal('markup_flights', 8, 2)->default(0);
            $table->decimal('markup_tours', 8, 2)->default(0);
            $table->decimal('markup_cars', 8, 2)->default(0);
            $table->string('agency_address')->nullable();
            $table->string('agency_city')->nullable();

            // Laravel auth helpers
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
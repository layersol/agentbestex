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
        Schema::create('flights_bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->string('booking_ref_no', 17)->nullable();
            $table->string('module_type', 50);
            $table->string('flight_type', 225)->nullable();
            $table->dateTime('booking_date');
            $table->enum('booking_status', ['confirmed', 'pending', 'cancelled'])->default('pending');
            $table->string('pnr', 225)->nullable();
            $table->string('order_number', 225)->nullable();
            $table->text('booking_additional_notes')->nullable();
            $table->double('price_original');
            $table->string('price_markup', 225)->nullable();
            $table->string('agent_markup_price', 255)->nullable();
            $table->string('agent_net_profit', 255)->nullable();
            $table->integer('agent_markup_percent')->nullable();
            $table->string('checkin', 255)->nullable();
            $table->string('checkout', 255)->nullable();
            $table->tinyInteger('booking_nights')->nullable();
            $table->tinyInteger('adults')->default(1);
            $table->tinyInteger('childs')->default(0);
            $table->string('infants', 225)->nullable();
            $table->string('currency_original', 50);
            $table->string('currency_markup', 225)->nullable();
            $table->bigInteger('payment_date')->nullable();
            $table->tinyInteger('cancellation_request')->default(0);
            $table->tinyInteger('cancellation_status')->default(0);
            $table->longText('booking_data')->nullable(); // JSON validation handled in code
            $table->text('booking_response')->nullable();
            $table->text('error_response')->nullable();
            $table->enum('payment_status', ['paid', 'unpaid', 'refunded'])->default('unpaid');
            $table->string('supplier', 255);
            $table->string('transaction_id', 255)->nullable();
            $table->string('user_id', 255)->nullable();
            $table->text('user_data')->nullable();
            $table->text('guest')->nullable();
            $table->string('nationality', 225)->nullable();
            $table->longText('routes')->nullable();
            $table->string('payment_gateway', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights_bookings');
    }
};
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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('todays_date');
            $table->string('client_name');
            $table->string('client_company');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('client_address');
            $table->string('list_price');
            $table->string('line_item');
            $table->string('shipping_price');
            $table->string('currency');
            $table->string('quantity');
            $table->string('price');
            $table->string('quote_number');
            $table->string('pdf_path')->nullable();
            $table->unsignedBigInteger('inventory_id')->nullable();
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};

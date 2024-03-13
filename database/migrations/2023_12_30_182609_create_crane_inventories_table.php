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
        Schema::create('crane_inventories', function (Blueprint $table) {
            // Main Structure Elements
            $table->id()->unique();
            $table->timestamps();
            $table->unsignedBigInteger('inventory_id');
            // Crane Based Elements
            $table->string('slugName')->nullable();
            $table->string('type')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('subject')->nullable();
            $table->string('year')->nullable();
            $table->string('capacity')->nullable();
            $table->string('boom')->nullable();
            $table->string('jib')->nullable();
            $table->string('jibType')->nullable();
            $table->string('hoursUpper')->nullable();
            $table->string('hoursLower')->nullable();
            $table->string('mileage')->nullable();
            $table->string('condition')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crane_inventories');
    }
};

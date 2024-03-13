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
        Schema::create('part_inventories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('inventory_id');
            $table->string('slugName')->nullable();
            $table->string('type')->nullable();
            $table->string('make')->nullable();
            $table->string('year')->nullable();
            $table->string('subject')->nullable();
            $table->string('condition')->nullable();
            $table->text('description')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_inventories');
    }
};

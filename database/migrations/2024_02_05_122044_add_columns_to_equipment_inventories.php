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
        Schema::table('equipment_inventories', function (Blueprint $table) {
            // Adding main columns now that website is in production already
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
        Schema::table('equipment_inventories', function (Blueprint $table) {
            //
            $table->dropColumn('inventory_id');
            $table->dropColumn('slugName');
            $table->dropColumn('type');
            $table->dropColumn('make');
            $table->dropColumn('year');
            $table->dropColumn('subject');
            $table->dropColumn('condition');
            $table->dropColumn('description');
        });
    }
};

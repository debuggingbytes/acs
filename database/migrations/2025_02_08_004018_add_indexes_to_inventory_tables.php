<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToInventoryTables extends Migration
{
    public function up()
    {
        Schema::table('crane_inventories', function (Blueprint $table) {
            $table->index(['make', 'model'], 'idx_crane_make_model');
            $table->index('year');
        });

        Schema::table('part_inventories', function (Blueprint $table) {
            $table->index('make');
            $table->index('year');
        });

        Schema::table('equipment_inventories', function (Blueprint $table) {
            $table->index('make');
            $table->index('year');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->index(['inventoryable_type', 'is_available'], 'idx_type_available');
        });
    }

    public function down()
    {
        Schema::table('crane_inventories', function (Blueprint $table) {
            $table->dropIndex('idx_crane_make_model');
            $table->dropIndex('crane_inventories_year_index');
        });

        Schema::table('part_inventories', function (Blueprint $table) {
            $table->dropIndex('part_inventories_make_index');
            $table->dropIndex('part_inventories_year_index');
        });

        Schema::table('equipment_inventories', function (Blueprint $table) {
            $table->dropIndex('equipment_inventories_make_index');
            $table->dropIndex('equipment_inventories_year_index');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->dropIndex('idx_type_available');
        });
    }
}

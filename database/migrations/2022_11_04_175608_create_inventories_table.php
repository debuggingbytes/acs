<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id()->unique();
            $table->timestamps();
            $table->string('inventoryable_type');
            $table->unsignedBigInteger('inventoryable_id')->nullable();
            $table->string('cost')->default('Please Contact')->nullable();
            $table->boolean('is_available')->default(true)->nullable();
            $table->boolean('is_featured')->default(false)->nullable();
            $table->string('serial_number')->nullable();
            $table->string('thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}

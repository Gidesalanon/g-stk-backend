<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            // $table->uuid('id')->primary();
            $table->uuid('product_id')->nullable();
            $table->double('quantity')->nullable();
            $table->date('expiration_date')->nullable();
            $table->uuid('command_id');
            $table->nullableTimestamps();

            $table->index(["command_id"], 'fk_command_command_idx');

            $table->foreign('command_id', 'fk_command_command_idx')
                ->references('id')->on('commands')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('product_id', 'fk_command_product_idx')
                ->references('id')->on('products')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('command_products');
    }
}

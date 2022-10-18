<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->longText('description');
            $table->unsignedTinyInteger('public')->default('1');
            $table->uuid('user_id');
            $table->uuid('client_id');
            $table->nullableTimestamps();

            $table->index(["user_id"], 'fk_selling_user_idx');

            $table->foreign('user_id', 'fk_selling_user_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        
            $table->index(["client_id"], 'fk_selling_client_idx');

            $table->foreign('client_id', 'fk_selling_client_idx')
                ->references('id')->on('clients')
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
        Schema::dropIfExists('sellings');
    }
}

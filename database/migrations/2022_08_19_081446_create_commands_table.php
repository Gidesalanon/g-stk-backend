<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->longText('description');
            $table->unsignedTinyInteger('public')->default('1');
            $table->uuid('user_id');
            $table->nullableTimestamps();

            $table->index(["user_id"], 'fk_command_user_idx');

            $table->foreign('user_id', 'fk_command_user_idx')
                ->references('id')->on('users')
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
        Schema::dropIfExists('commands');
    }
}

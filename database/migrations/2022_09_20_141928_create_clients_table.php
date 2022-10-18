<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('phone', 20)->unique();
            $table->string('email', 100)->unique();
            $table->string('address', 255)->nullable();
            $table->string('ifu', 255)->nullable();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->longText('description')->nullable();
            $table->uuid('user_id');
            $table->unsignedTinyInteger('public')->default('0');
            $table->nullableTimestamps();
            
            $table->index(["user_id"], 'fk_client_user_idx');

            $table->foreign('user_id', 'fk_client_user_idx')
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
        Schema::dropIfExists('clients');
    }
}

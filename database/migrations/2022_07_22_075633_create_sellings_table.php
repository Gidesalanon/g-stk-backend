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
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->integer('qty');
            $table->longText('description');
            $table->uuid('fichier_id')->nullable();
            $table->uuid('product_id')->nullable();
            $table->unsignedTinyInteger('public')->default('0');
            $table->uuid('user_id');
            $table->nullableTimestamps();

            $table->index(["fichier_id"], 'fk_selling_fichier_idx');

            $table->index(["user_id"], 'fk_selling_user_idx');

            $table->foreign('user_id', 'fk_selling_user_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('product_id', 'fk_selling_product_idx')
                ->references('id')->on('products')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('fichier_id', 'fk_selling_fichier_idx')
                ->references('id')->on('fichiers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}

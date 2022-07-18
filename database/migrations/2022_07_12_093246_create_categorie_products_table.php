<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorieProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'categorie_products';

    /**
     * Run the migrations.
     * @table categorie_products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->uuid('fichier_id')->nullable();
            $table->longText('description');
            $table->unsignedTinyInteger('public')->default('0');
            $table->uuid('user_id');
            $table->nullableTimestamps();

            $table->index(["fichier_id"], 'fk_product_fichier1_idx');

            $table->index(["user_id"], 'fk_product_user1_idx');

            $table->foreign('user_id', 'fk_product_user1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('fichier_id', 'fk_product_fichier1_idx')
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

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
            $table->string('name', 255)->unique();
            $table->longText('description');
            $table->uuid('fichier_id')->nullable();
            $table->unsignedTinyInteger('public')->default('0');
            $table->nullableTimestamps();

            $table->index(["fichier_id"], 'fk_product_fichier1_idx');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'products';

    /**
     * Run the migrations.
     * @table products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('name', 255)->unique();
            $table->double('client_price');
            $table->double('partner_price');
            $table->double('point')->default('0');
            $table->longText('description')->nullable();
            $table->uuid('fichier_id')->nullable();
            $table->uuid('categorie_id')->nullable();
            $table->unsignedTinyInteger('public')->default('0');
            $table->uuid('user_id');
            $table->nullableTimestamps();

            $table->index(["fichier_id"], 'fk_product_fichier_idx');

            $table->index(["user_id"], 'fk_product_user_idx');

            $table->foreign('user_id', 'fk_product_user_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('fichier_id', 'fk_product_fichier_idx')
                ->references('id')->on('fichiers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        
            $table->foreign('categorie_id', 'fk_product_categorie_idx')
                ->references('id')->on('categorie_products')
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

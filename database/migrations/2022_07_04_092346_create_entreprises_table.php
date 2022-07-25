<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntreprisesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'entreprises';

    /**
     * Run the migrations.
     * @table entreprises
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('name', 255)->unique();
            $table->uuid('fichier_id')->nullable();
            $table->longText('presentation');
            $table->unsignedTinyInteger('public')->default('0');
            $table->uuid('user_id');
            $table->nullableTimestamps();

            $table->index(["fichier_id"], 'fk_entreprise_fichier1_idx');

            $table->index(["user_id"], 'fk_entreprise_user1_idx');

            $table->foreign('user_id', 'fk_entreprise_user1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('fichier_id', 'fk_entreprise_fichier1_idx')
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

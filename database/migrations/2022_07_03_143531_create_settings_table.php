<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('organisation_name', 255);
            $table->string('director_name', 255);
            $table->string('director_position', 255);
            $table->longText('welcome_content')->nullable();
            $table->string('welcome_title')->nullable();
            $table->uuid('fichier_id')->nullable();         // Picture of Director
            $table->nullableTimestamps();

            $table->index(["fichier_id"], 'fk_setting_fichier1_idx');

            $table->foreign('fichier_id', 'fk_setting_fichier1_idx')
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
        Schema::dropIfExists('settings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserParentTable extends Migration
{
    private $foreignKeyName = 'fk_users_parent1_idx';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('parent_id')->nullable();

            $table->index(["parent_id"], 'fk_user_parent2_idx');
            $table->foreign('parent_id', 'fk_user_parent2_idx')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('no action');
            
            $table->index(["parent_id"], $this->foreignKeyName);

            $table->foreign('parent_id', $this->foreignKeyName)
                ->references('id')->on('users')
                ->onDelete('set null')
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
        //
    }
}

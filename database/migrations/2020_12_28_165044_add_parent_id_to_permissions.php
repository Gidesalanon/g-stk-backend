<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToPermissions extends Migration
{
    private $foreignKeyName = 'fk_permissions_permissions1_idx';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        Schema::table('permissions', function (Blueprint $table) use ($tableNames) {
            $table->uuid('parent_id')->nullable();

            $table->foreign('parent_id', $this->foreignKeyName)
                ->references('id')->on($tableNames['permissions'])
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
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign($this->foreignKeyName);
            $table->dropColumn(['parent_id']);
        });
    }
}


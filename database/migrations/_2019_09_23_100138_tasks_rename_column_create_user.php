<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TasksRenameColumnCreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()  {
		Schema::table('tasks', function (Blueprint $table) {
			$table->renameColumn('create_user', 'user_id');
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

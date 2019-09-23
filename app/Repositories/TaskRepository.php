<?php
/**
 * Created by PhpStorm.
 * User: Sergey62
 * Date: 23.09.2019
 * Time: 14:56
 */
namespace App\Repositories;

use App\Models\User;

class TaskRepository {

	public function forUser(User $user) {
		return $user->tasks()->get();
	}
}
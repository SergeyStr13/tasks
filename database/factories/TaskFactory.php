<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Task::class, function (Faker $faker) {
    return [
        'name' => '333',
        'user_id' => 1,
        'image' => 'image/'.\Illuminate\Support\Str::random(10).'.jpg',
	];
});

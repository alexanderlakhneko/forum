<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Reply::class, function (Faker $faker) {
    return [
        'body'  => $faker->paragraph,
        'user_id' => function() {
            return factory(\App\Models\User::class)->create()->id;
        },
        'thread_id' => function() {
            return factory(\App\Models\Thread::class)->create()->id;
        },
    ];
});



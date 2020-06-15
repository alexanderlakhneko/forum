<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Reply;
use App\Models\User;
use App\Models\Thread;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body'  => $faker->paragraph,
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'thread_id' => function() {
            return factory(Thread::class)->create()->id;
        },
    ];
});



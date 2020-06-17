<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title'      => $faker->sentence,
        'body'       => $faker->paragraph,
        'channel_id' => function () {
            return factory(Channel::class)->create()->id;
        },
        'user_id'    => function () {
            return factory(User::class)->create()->id;
        }
    ];
});

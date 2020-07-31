<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence(),
        'created_at' => null,
        'updated_at' => null,
        'topic_id' => rand(1,100),
        'user_id' => rand(1,10),
    ];
});

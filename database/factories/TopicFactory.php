<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();

    // 随机取一个月以内的时间
    $updated_at = null;

    // 为创建时间传参，意为最大不超过 $updated_at，因为创建时间需永远比更改时间要早
    $created_at = null;

    return [
        'title' => $sentence,
        'body' => $faker->text(),
        'excerpt' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});

<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Models\RoleUser::class, function (Faker\Generator $faker) {
    return [
        'user_id' => rand(1,4),
        'role_id' => rand(1,10)
    ];
});

$factory->define(App\Models\Country::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->country
    ];
});

$factory->define(App\Models\Video::class,function(Faker\Generator $faker){
    return [
        'title' => $faker->text(5),
        'content' => $faker->realText(),
        'desc' => $faker->realText(10),
        'user_id' => $faker->numberBetween(1,4),
        'status' => $faker->numberBetween(0,1)
    ];
});


$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => 'comment '.$faker->randomDigitNotNull,
        'user_id' => $faker->numberBetween(1,4),
        'item_id' => $faker->numberBetween(1,20),
        'item_type' => 'App\Models\\'.$faker->randomElement(['Post','Video'])
    ];
});


$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => 'tag '.$faker->randomDigitNotNull,
        'nums' => $faker->randomDigitNotNull
    ];
});

$factory->define(App\Models\Taggable::class, function (Faker\Generator $faker) {
    return [
        'taggable_id' => $faker->numberBetween(1,20),
        'taggable_type'=>'App\Models\\'.$faker->randomElement(['Post','Video']),
        'tag_id' => $faker->numberBetween(1,20)
    ];
});
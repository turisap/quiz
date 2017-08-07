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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {

    return [
        'first_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'student'  => 1,
        'teacher'  => $faker->boolean(),
        'admin'    => $faker->boolean(),
        'premium'    => 0,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Quiz::class, function (Faker\Generator $faker) {

    return [
        'author_id' => $faker->biasedNumberBetween(1, 10),
        'title'  => $faker->sentence,
        'category_id' => $faker->biasedNumberBetween(1, 6),
        'description' => $faker->paragraph,
        'picture'     => $faker->word,
        'views'      => $faker->biasedNumberBetween(1, 100),
        'premium'    => $faker->boolean()
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Liked::class, function (Faker\Generator $faker) {

    return [
        'user_id' => $faker->biasedNumberBetween(1, 10),
        'quiz_id' => $faker->biasedNumberBetween(1, 40)
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {

    return [
        'quiz_id'      => $faker->biasedNumberBetween(1, 40),
        'question'        => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'answer1'     => $faker->word,
        'answer2'     => $faker->word,
        'answer3'     => $faker->word,
        'answer4'     => $faker->word,
        'answer' => $faker->biasedNumberBetween(1, 4)
    ];
});


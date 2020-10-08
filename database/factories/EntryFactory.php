<?php

use App\Entry;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Entry::class, function (Faker $faker) {
    return [
        'start' => \App\Helpers\helper::getNow(),
        'end' => null,
        'project_id' => 1
    ];
});

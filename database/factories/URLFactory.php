<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\URL;
use App\Services\URLService;
use Faker\Generator as Faker;

$factory->define(URL::class, function (Faker $faker) {
    return [
        'url'    => $faker->url,
        'hash'   => (new URLService)->generateHash($faker->url),
        'visits' => $faker->numberBetween(0,1000)
    ];
});

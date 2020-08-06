<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'invoice_number'=>$faker->randomDigitNotNull,
        'invoice_at' => $faker->date(),
        'amount'=>$faker->randomDigit,
        'currency'=>$faker->boolean ? "riel":"usd",
        'total'=>$faker->randomFloat(3,0,10000),
        'customer_id'=>App\Customer::pluck("id")->random(),
    ];
});

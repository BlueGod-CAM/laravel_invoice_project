<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InvoiceItem;
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

$factory->define(InvoiceItem::class, function (Faker $faker) {
    return [
        'invoice_id'=>App\Invoice::pluck("id")->random(),
        'item_id'=> App\Item::pluck("id")->random(),
        'quantity'=>$faker->randomDigitNotNull,
        'price'=>$faker->randomFloat(100,0,100),
        'total'=>$faker->randomFloat(100,0,10000),

    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Buihuycuong\Vnfaker\VNFaker;

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

$factory->define(User::class, function (Faker $faker) {
    $domain = ['gmail.com', 'outlook.com', 'example.com'];
    return [
        'mail_address' => vnfaker()->email($domain),
        'name' => vnfaker()->fullname($word = 3),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'address' => $faker->address(),
        'phone' => vnfaker()->mobilephone($numbers = 10),
    ];
});

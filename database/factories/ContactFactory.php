<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
      'first_name' => $this->faker->name,
      'last_name' => $this->faker->lastname,
      'email' => $this->faker->unique()->safeEmail,
      'phone' => $this->faker->phone,
      'address' => $this->faker->address
        //
    ];
});

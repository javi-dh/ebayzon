<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
	return [
	  'name' => $faker->unique()->randomElement([
		  'Tecnología',
		  'Bebidas',
		  'Autos',
		  'Coding Scholl',
		  'Indumentaria',
	  ]),
	];
});

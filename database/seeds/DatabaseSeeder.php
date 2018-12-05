<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	* Seed the application's database.
	*
	* @return void
	*/
	public function run()
	{
		// $this->call(UsersTableSeeder::class);
		factory(App\User::class)->times(150)->create();

		$products = factory(App\Product::class)->times(10)->create();
		$brands = factory(App\Brand::class)->times(5)->create();
		$categories = factory(App\Category::class)->times(5)->create();
		$colors = factory(App\Color::class)->times(15)->create();

		foreach ($products as $oneProduct) {
			$oneProduct->brand()->associate($brands->random(1)->first()->id);
			$oneProduct->category()->associate($categories->random(1)->first()->id);
			$oneProduct->save();

			$oneProduct->colors()->sync($colors->random(3));
		}
	}
}

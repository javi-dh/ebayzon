<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = ['name', 'price', 'image', 'category_id', 'brand_id'];

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function colors()
	{
		return $this->belongsToMany(Color::class)->withTimestamps();
	}
}

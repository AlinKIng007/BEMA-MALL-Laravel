<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $category_id
 * 
 * @property Category|null $category
 * @property Collection|Category[] $categories
 * @property Collection|MainProduct[] $main_products
 * @property Collection|OfferConfiguration[] $offer_configurations
 * @property Collection|Variation[] $variations
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function categories()
	{
		return $this->hasMany(Category::class);
	}

	public function main_products()
	{
		return $this->hasMany(MainProduct::class);
	}

	public function offer_configurations()
	{
		return $this->hasMany(OfferConfiguration::class);
	}

	public function variations()
	{
		return $this->hasMany(Variation::class);
	}
}

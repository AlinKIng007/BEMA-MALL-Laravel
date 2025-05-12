<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MainProduct
 * 
 * @property int $id
 * @property string|null $sku
 * @property float|null $product_weight_in_grams
 * @property string|null $product_name
 * @property string|null $description
 * @property int|null $category_id
 * @property string|null $image_1
 * @property string|null $image_2
 * @property string|null $image_3
 * @property Carbon|null $production_date
 * @property Carbon|null $expiration_date
 * 
 * @property Category|null $category
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class MainProduct extends Model
{
	protected $table = 'main_products';
	public $timestamps = false;

	protected $casts = [
		'product_weight_in_grams' => 'float',
		'category_id' => 'int',
		'production_date' => 'datetime',
		'expiration_date' => 'datetime'
	];

	protected $fillable = [
		'sku',
		'product_weight_in_grams',
		'product_name',
		'description',
		'category_id',
		'image_1',
		'image_2',
		'image_3',
		'production_date',
		'expiration_date'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}

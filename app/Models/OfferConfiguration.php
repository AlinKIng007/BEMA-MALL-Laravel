<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferConfiguration
 * 
 * @property int $id
 * @property int|null $offer_id
 * @property int|null $category_id
 * @property int|null $product_id
 * 
 * @property Category|null $category
 * @property Offer|null $offer
 * @property Product|null $product
 *
 * @package App\Models
 */
class OfferConfiguration extends Model
{
	protected $table = 'offer_configurations';
	public $timestamps = false;

	protected $casts = [
		'offer_id' => 'int',
		'category_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'offer_id',
		'category_id',
		'product_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function offer()
	{
		return $this->belongsTo(Offer::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}

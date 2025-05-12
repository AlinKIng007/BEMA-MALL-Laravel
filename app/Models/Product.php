<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property int|null $main_product_id
 * @property string|null $sku
 * @property int|null $amount
 * @property int|null $price
 * @property int|null $offer_id
 * @property int|null $position_id
 * @property bool|null $is_published
 * @property int|null $shipment_id
 * @property Carbon|null $date_added
 * @property string|null $barcode
 * 
 * @property MainProduct|null $main_product
 * @property Position|null $position
 * @property Shipment|null $shipment
 * @property Collection|Cart[] $carts
 * @property Collection|OfferConfiguration[] $offer_configurations
 * @property Collection|Order[] $orders
 * @property Collection|ProductConfig[] $product_configs
 * @property Collection|Wishlist[] $wishlists
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';
	public $timestamps = false;

	protected $casts = [
		'main_product_id' => 'int',
		'amount' => 'int',
		'price' => 'int',
		'offer_id' => 'int',
		'position_id' => 'int',
		'is_published' => 'bool',
		'shipment_id' => 'int',
		'date_added' => 'datetime'
	];

	protected $fillable = [
		'main_product_id',
		'sku',
		'amount',
		'price',
		'offer_id',
		'position_id',
		'is_published',
		'shipment_id',
		'date_added',
		'barcode'
	];

	public function main_product()
	{
		return $this->belongsTo(MainProduct::class);
	}

	public function position()
	{
		return $this->belongsTo(Position::class);
	}

	public function shipment()
	{
		return $this->belongsTo(Shipment::class);
	}

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}

	public function offer_configurations()
	{
		return $this->hasMany(OfferConfiguration::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function product_configs()
	{
		return $this->hasMany(ProductConfig::class);
	}

	public function wishlists()
	{
		return $this->hasMany(Wishlist::class);
	}
}

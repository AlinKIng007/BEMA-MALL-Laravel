<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ShopCoupon
 * 
 * @property int $id
 * @property int|null $shop_id
 * @property int|null $coupon_id
 * 
 * @property Coupon|null $coupon
 * @property Shop|null $shop
 *
 * @package App\Models
 */
class ShopCoupon extends Model
{
	protected $table = 'shop_coupon';
	public $timestamps = false;

	protected $casts = [
		'shop_id' => 'int',
		'coupon_id' => 'int'
	];

	protected $fillable = [
		'shop_id',
		'coupon_id'
	];

	public function coupon()
	{
		return $this->belongsTo(Coupon::class);
	}

	public function shop()
	{
		return $this->belongsTo(Shop::class);
	}
}

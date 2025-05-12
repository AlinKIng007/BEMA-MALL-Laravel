<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Coupon
 * 
 * @property int $id
 * @property string|null $discount
 * @property string|null $code
 * @property int|null $is_active
 * 
 * @property Collection|Order[] $orders
 * @property Collection|Shop[] $shops
 *
 * @package App\Models
 */
class Coupon extends Model
{
	protected $table = 'coupons';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'discount',
		'code',
		'is_active'
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function shops()
	{
		return $this->belongsToMany(Shop::class, 'shop_coupon')
					->withPivot('id');
	}
}

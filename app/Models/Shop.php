<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Shop
 * 
 * @property int $id
 * @property string|null $shop_name
 * @property int|null $monthly_rent
 * @property int|null $monthly_ad
 * @property int|null $floor_id
 * @property int|null $north_in_meters
 * @property int|null $east_in_meters
 * 
 * @property Floor|null $floor
 * @property Collection|Shelf[] $shelves
 * @property Collection|Coupon[] $coupons
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Shop extends Model
{
	protected $table = 'shops';
	public $timestamps = false;

	protected $casts = [
		'monthly_rent' => 'int',
		'monthly_ad' => 'int',
		'floor_id' => 'int',
		'north_in_meters' => 'int',
		'east_in_meters' => 'int'
	];

	protected $fillable = [
		'shop_name',
		'monthly_rent',
		'monthly_ad',
		'floor_id',
		'north_in_meters',
		'east_in_meters'
	];

	public function floor()
	{
		return $this->belongsTo(Floor::class);
	}

	public function shelves()
	{
		return $this->hasMany(Shelf::class);
	}

	public function coupons()
	{
		return $this->belongsToMany(Coupon::class, 'shop_coupon')
					->withPivot('id');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_shop')
					->withPivot('id', 'time_of_acquisition', 'start_date', 'end_date');
	}
}

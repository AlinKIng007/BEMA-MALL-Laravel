<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserShop
 * 
 * @property int $id
 * @property int|null $shop_id
 * @property int|null $user_id
 * @property Carbon|null $time_of_acquisition
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * 
 * @property Shop|null $shop
 * @property User|null $user
 *
 * @package App\Models
 */
class UserShop extends Model
{
	protected $table = 'user_shop';
	public $timestamps = false;

	protected $casts = [
		'shop_id' => 'int',
		'user_id' => 'int',
		'time_of_acquisition' => 'datetime',
		'start_date' => 'datetime',
		'end_date' => 'datetime'
	];

	protected $fillable = [
		'shop_id',
		'user_id',
		'time_of_acquisition',
		'start_date',
		'end_date'
	];

	public function shop()
	{
		return $this->belongsTo(Shop::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

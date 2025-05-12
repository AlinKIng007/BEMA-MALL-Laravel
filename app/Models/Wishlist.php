<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Wishlist
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int|null $product_id
 * 
 * @property Product|null $product
 * @property User|null $user
 *
 * @package App\Models
 */
class Wishlist extends Model
{
	protected $table = 'wishlist';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'product_id'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

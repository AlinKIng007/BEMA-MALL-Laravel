<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $product_id
 * @property int|null $amount
 *
 * @property Product|null $product
 * @property User|null $user
 *
 * @package App\Models
 */
class Cart extends Model
{
	protected $table = 'cart';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'product_id' => 'int',
		'amount' => 'int'
	];

	protected $fillable = [
		'user_id',
		'product_id',
		'amount'
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

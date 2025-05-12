<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $amount
 * @property Carbon|null $time_of_purchase
 * @property int|null $status_id
 * @property int|null $payment_method_id
 * @property int|null $product_id
 * @property int|null $employee_id
 * @property int|null $coupon_id
 *
 * @property Coupon|null $coupon
 * @property Employee|null $employee
 * @property PaymentMethod|null $payment_method
 * @property Product|null $product
 * @property Status|null $status
 * @property User|null $user
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'amount' => 'int',
		'time_of_purchase' => 'datetime',
		'status_id' => 'int',
		'payment_method_id' => 'int',
		'product_id' => 'int',
		'employee_id' => 'int',
		'coupon_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'amount',
		'time_of_purchase',
		'status_id',
		'payment_method_id',
		'product_id',
		'employee_id',
		'coupon_id'
	];

	public function coupon()
	{
		return $this->belongsTo(Coupon::class);
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}

	public function payment_method()
	{
		return $this->belongsTo(PaymentMethod::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

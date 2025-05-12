<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Shipment
 * 
 * @property int $id
 * @property int|null $supplier_id
 * @property Carbon|null $requested_on_time
 * @property Carbon|null $expected_arrival_time
 * @property int|null $each_price
 * @property int|null $amount
 * @property bool|null $pending
 * @property bool|null $processing
 * @property bool|null $cancelled
 * @property bool|null $delivered
 * @property Carbon|null $actual_arrival_time
 * 
 * @property Supplier|null $supplier
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Shipment extends Model
{
	protected $table = 'shipments';
	public $timestamps = false;

	protected $casts = [
		'supplier_id' => 'int',
		'requested_on_time' => 'datetime',
		'expected_arrival_time' => 'datetime',
		'each_price' => 'int',
		'amount' => 'int',
		'pending' => 'bool',
		'processing' => 'bool',
		'cancelled' => 'bool',
		'delivered' => 'bool',
		'actual_arrival_time' => 'datetime'
	];

	protected $fillable = [
		'supplier_id',
		'requested_on_time',
		'expected_arrival_time',
		'each_price',
		'amount',
		'pending',
		'processing',
		'cancelled',
		'delivered',
		'actual_arrival_time'
	];

	public function supplier()
	{
		return $this->belongsTo(Supplier::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}

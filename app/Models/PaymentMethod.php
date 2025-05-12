<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethod
 * 
 * @property int $id
 * @property string|null $description
 * @property string|null $method_name
 * @property int|null $face_to_face
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class PaymentMethod extends Model
{
	protected $table = 'payment_method';
	public $timestamps = false;

	protected $casts = [
		'face_to_face' => 'int'
	];

	protected $fillable = [
		'description',
		'method_name',
		'face_to_face'
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}

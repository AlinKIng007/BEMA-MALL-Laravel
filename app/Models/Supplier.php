<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Supplier
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $address
 * @property string|null $email
 * @property string|null $phone_number
 * 
 * @property Collection|Shipment[] $shipments
 *
 * @package App\Models
 */
class Supplier extends Model
{
	protected $table = 'suppliers';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
		'address',
		'email',
		'phone_number'
	];

	public function shipments()
	{
		return $this->hasMany(Shipment::class);
	}
}

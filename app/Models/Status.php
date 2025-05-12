<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * 
 * @property int $id
 * @property string|null $type
 * @property string|null $description
 * @property int|null $level
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class Status extends Model
{
	protected $table = 'status';
	public $timestamps = false;

	protected $casts = [
		'level' => 'int'
	];

	protected $fillable = [
		'type',
		'description',
		'level'
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}

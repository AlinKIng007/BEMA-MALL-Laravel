<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mall
 * 
 * @property int $id
 * @property string|null $mall_name
 * @property string|null $mall_address
 * @property int|null $has_3d
 * @property int|null $has_2d
 * 
 * @property Collection|Department[] $departments
 * @property Collection|Event[] $events
 * @property Collection|Floor[] $floors
 *
 * @package App\Models
 */
class Mall extends Model
{
	protected $table = 'malls';
	public $timestamps = false;

	protected $casts = [
		'has_3d' => 'int',
		'has_2d' => 'int'
	];

	protected $fillable = [
		'mall_name',
		'mall_address',
		'has_3d',
		'has_2d'
	];

	public function departments()
	{
		return $this->hasMany(Department::class);
	}

	public function events()
	{
		return $this->hasMany(Event::class);
	}

	public function floors()
	{
		return $this->hasMany(Floor::class);
	}
}

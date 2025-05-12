<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * 
 * @property int $id
 * @property string|null $gender
 * @property Carbon|null $hire_date
 * @property float|null $salary
 * @property int|null $user_id
 * 
 * @property User|null $user
 * @property Collection|Department[] $departments
 * @property Collection|Order[] $orders
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Employee extends Model
{
	protected $table = 'employees';
	public $timestamps = false;

	protected $casts = [
		'hire_date' => 'datetime',
		'salary' => 'float',
		'user_id' => 'int'
	];

	protected $fillable = [
		'gender',
		'hire_date',
		'salary',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function departments()
	{
		return $this->belongsToMany(Department::class)
					->withPivot('id');
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function roles()
	{
		return $this->hasMany(Role::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $mall_id
 * 
 * @property Mall|null $mall
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'departments';
	public $timestamps = false;

	protected $casts = [
		'mall_id' => 'int'
	];

	protected $fillable = [
		'name',
		'mall_id'
	];

	public function mall()
	{
		return $this->belongsTo(Mall::class);
	}

	public function employees()
	{
		return $this->belongsToMany(Employee::class)
					->withPivot('id');
	}
}

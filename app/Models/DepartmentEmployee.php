<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DepartmentEmployee
 * 
 * @property int $id
 * @property int|null $department_id
 * @property int|null $employee_id
 * 
 * @property Department|null $department
 * @property Employee|null $employee
 *
 * @package App\Models
 */
class DepartmentEmployee extends Model
{
	protected $table = 'department_employee';
	public $timestamps = false;

	protected $casts = [
		'department_id' => 'int',
		'employee_id' => 'int'
	];

	protected $fillable = [
		'department_id',
		'employee_id'
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}
}

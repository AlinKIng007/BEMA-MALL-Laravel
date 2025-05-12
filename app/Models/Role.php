<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property int|null $title_id
 * @property int|null $employee_id
 * 
 * @property Employee|null $employee
 * @property Title|null $title
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	public $timestamps = false;

	protected $casts = [
		'title_id' => 'int',
		'employee_id' => 'int'
	];

	protected $fillable = [
		'title_id',
		'employee_id'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}

	public function title()
	{
		return $this->belongsTo(Title::class);
	}
}

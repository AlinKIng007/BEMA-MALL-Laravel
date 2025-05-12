<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Title
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $allowance
 * 
 * @property Collection|Role[] $roles
 * @property Collection|Table[] $tables
 *
 * @package App\Models
 */
class Title extends Model
{
	protected $table = 'titles';
	public $timestamps = false;

	protected $casts = [
		'allowance' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'allowance'
	];

	public function roles()
	{
		return $this->hasMany(Role::class);
	}

	public function tables()
	{
		return $this->belongsToMany(Table::class)
					->withPivot('id');
	}
}

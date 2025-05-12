<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Table
 * 
 * @property int $id
 * @property string|null $table_name
 * 
 * @property Collection|Title[] $titles
 *
 * @package App\Models
 */
class Table extends Model
{
	protected $table = 'tables';
	public $timestamps = false;

	protected $fillable = [
		'table_name'
	];

	public function titles()
	{
		return $this->belongsToMany(Title::class)
					->withPivot('id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShelfType
 * 
 * @property int $id
 * @property string|null $type
 * @property int|null $compartments
 * 
 * @property Collection|Shelf[] $shelves
 *
 * @package App\Models
 */
class ShelfType extends Model
{
	protected $table = 'shelf_types';
	public $timestamps = false;

	protected $casts = [
		'compartments' => 'int'
	];

	protected $fillable = [
		'type',
		'compartments'
	];

	public function shelves()
	{
		return $this->hasMany(Shelf::class);
	}
}

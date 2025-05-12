<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Position
 * 
 * @property int $id
 * @property int|null $shelf_id
 * @property int|null $x
 * @property int|null $z
 * 
 * @property Shelf|null $shelf
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Position extends Model
{
	protected $table = 'positions';
	public $timestamps = false;

	protected $casts = [
		'shelf_id' => 'int',
		'x' => 'int',
		'z' => 'int'
	];

	protected $fillable = [
		'shelf_id',
		'x',
		'z'
	];

	public function shelf()
	{
		return $this->belongsTo(Shelf::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}

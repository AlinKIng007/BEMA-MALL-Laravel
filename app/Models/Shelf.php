<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Shelf
 * 
 * @property int $id
 * @property int|null $shop_id
 * @property int|null $shelf_type_id
 * @property float|null $from_north
 * @property float|null $to_north
 * @property float|null $from_east
 * @property float|null $to_east
 * @property int|null $height
 * @property int|null $width
 * 
 * @property ShelfType|null $shelf_type
 * @property Shop|null $shop
 * @property Collection|Position[] $positions
 *
 * @package App\Models
 */
class Shelf extends Model
{
	protected $table = 'shelves';
	public $timestamps = false;

	protected $casts = [
		'shop_id' => 'int',
		'shelf_type_id' => 'int',
		'from_north' => 'float',
		'to_north' => 'float',
		'from_east' => 'float',
		'to_east' => 'float',
		'height' => 'int',
		'width' => 'int'
	];

	protected $fillable = [
		'shop_id',
		'shelf_type_id',
		'from_north',
		'to_north',
		'from_east',
		'to_east',
		'height',
		'width'
	];

	public function shelf_type()
	{
		return $this->belongsTo(ShelfType::class);
	}

	public function shop()
	{
		return $this->belongsTo(Shop::class);
	}

	public function positions()
	{
		return $this->hasMany(Position::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Variation
 * 
 * @property int $id
 * @property int|null $category_id
 * @property string|null $name
 * 
 * @property Category|null $category
 * @property Collection|VariationOption[] $variation_options
 *
 * @package App\Models
 */
class Variation extends Model
{
	protected $table = 'variation';
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int'
	];

	protected $fillable = [
		'category_id',
		'name'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function variation_options()
	{
		return $this->hasMany(VariationOption::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VariationOption
 * 
 * @property int $id
 * @property int|null $variation_id
 * @property string|null $value
 * 
 * @property Variation|null $variation
 * @property Collection|ProductConfig[] $product_configs
 *
 * @package App\Models
 */
class VariationOption extends Model
{
	protected $table = 'variation_option';
	public $timestamps = false;

	protected $casts = [
		'variation_id' => 'int'
	];

	protected $fillable = [
		'variation_id',
		'value'
	];

	public function variation()
	{
		return $this->belongsTo(Variation::class);
	}

	public function product_configs()
	{
		return $this->hasMany(ProductConfig::class);
	}
}

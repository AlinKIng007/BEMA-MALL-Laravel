<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductConfig
 * 
 * @property int $id
 * @property int|null $product_id
 * @property int|null $variation_option_id
 * 
 * @property Product|null $product
 * @property VariationOption|null $variation_option
 *
 * @package App\Models
 */
class ProductConfig extends Model
{
	protected $table = 'product_config';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'variation_option_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'variation_option_id'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function variation_option()
	{
		return $this->belongsTo(VariationOption::class);
	}
}

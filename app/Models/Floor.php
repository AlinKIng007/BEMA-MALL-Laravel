<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Floor
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $mall_id
 * @property string|null $test
 * 
 * @property Mall|null $mall
 * @property Collection|Shop[] $shops
 *
 * @package App\Models
 */
class Floor extends Model
{
	protected $table = 'floors';
	public $timestamps = false;

	protected $casts = [
		'mall_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'mall_id',
		'test'
	];

	public function mall()
	{
		return $this->belongsTo(Mall::class);
	}

	public function shops()
	{
		return $this->hasMany(Shop::class);
	}
}

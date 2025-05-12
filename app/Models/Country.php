<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $name
 * @property string $abv
 * @property string|null $abv3
 * @property string|null $abv3_alt
 * @property string|null $code
 * @property string $slug
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'abv',
		'abv3',
		'abv3_alt',
		'code',
		'slug'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}

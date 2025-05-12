<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Offer
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $discount_rate
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * 
 * @property Collection|OfferConfiguration[] $offer_configurations
 *
 * @package App\Models
 */
class Offer extends Model
{
	protected $table = 'offers';
	public $timestamps = false;

	protected $casts = [
		'discount_rate' => 'int',
		'start_date' => 'datetime',
		'end_date' => 'datetime'
	];

	protected $fillable = [
		'name',
		'discount_rate',
		'start_date',
		'end_date'
	];

	public function offer_configurations()
	{
		return $this->hasMany(OfferConfiguration::class);
	}
}

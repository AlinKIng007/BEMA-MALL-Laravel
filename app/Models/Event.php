<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * 
 * @property int $id
 * @property string|null $event_name
 * @property Carbon|null $start_time
 * @property int|null $mall_id
 * @property string|null $description
 * @property string|null $image
 * @property Carbon|null $end_time
 * @property int|null $event_id
 * 
 * @property Mall|null $mall
 * @property EventType|null $event_type
 *
 * @package App\Models
 */
class Event extends Model
{
	protected $table = 'events';
	public $timestamps = false;

	protected $casts = [
		'start_time' => 'datetime',
		'mall_id' => 'int',
		'end_time' => 'datetime',
		'event_id' => 'int'
	];

	protected $fillable = [
		'event_name',
		'start_time',
		'mall_id',
		'description',
		'image',
		'end_time',
		'event_id'
	];

	public function mall()
	{
		return $this->belongsTo(Mall::class);
	}

	public function event_type()
	{
		return $this->belongsTo(EventType::class, 'event_id');
	}
}

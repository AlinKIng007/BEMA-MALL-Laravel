<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EventType
 * 
 * @property int $id
 * @property string|null $type
 * 
 * @property Collection|Event[] $events
 *
 * @package App\Models
 */
class EventType extends Model
{
	protected $table = 'event_type';
	public $timestamps = false;

	protected $fillable = [
		'type'
	];

	public function events()
	{
		return $this->hasMany(Event::class, 'event_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $subject
 * @property Carbon|null $time_of_submission
 * @property int|null $user_id
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class Ticket extends Model
{
	protected $table = 'tickets';
	public $timestamps = false;

	protected $casts = [
		'time_of_submission' => 'datetime',
		'user_id' => 'int'
	];

	protected $fillable = [
		'title',
		'subject',
		'time_of_submission',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

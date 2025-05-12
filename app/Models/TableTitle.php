<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TableTitle
 * 
 * @property int $id
 * @property int|null $table_id
 * @property int|null $title_id
 * 
 * @property Table|null $table
 * @property Title|null $title
 *
 * @package App\Models
 */
class TableTitle extends Model
{
	protected $table = 'table_title';
	public $timestamps = false;

	protected $casts = [
		'table_id' => 'int',
		'title_id' => 'int'
	];

	protected $fillable = [
		'table_id',
		'title_id'
	];

	public function table()
	{
		return $this->belongsTo(Table::class);
	}

	public function title()
	{
		return $this->belongsTo(Title::class);
	}
}

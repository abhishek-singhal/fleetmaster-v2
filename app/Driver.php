<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
	protected $table = 'drivers';
	protected $fillable = [
		'event_id', 'user_id',
	];
	
    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
    	'user_id', 'name', 'server', 'source', 'destination', 'time', 'trailer', 'route', 'ets2c', 'sheet', 'notes',
    ];
}

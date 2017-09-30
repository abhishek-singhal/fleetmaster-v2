<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRole extends Model
{
    protected $table = 'event_roles';
    protected $fillable = [
    	'event_id', 'user_id', 'role_id', 'confirm',
    ];

    public $timestamps = false;
}

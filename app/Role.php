<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    #Relación con users
    public function users()
    {
    	return $this->belongsToMany('Roscio\User', 'user_role', 'role_id', 'user_id');
    }
}

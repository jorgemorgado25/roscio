<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    public function student()
    {
    	return $this->belongsTo('Roscio\Student', 'student_id');
    }

    public function person()
    {
    	return $this->belongsTo('Roscio\Person', 'person_id');
    }
}

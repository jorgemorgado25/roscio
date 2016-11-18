<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
    protected $fillable = ['ci', 'full_name', 'birthday', 'birth_place', 'gender'];

    public function registers()
    {
    	return $this->hasMany('Roscio\Register', 'student_id');
    }
}

<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
    protected $fillable = ['ci', 'full_name', 'birthday', 'birth_place', 'gender'];
}

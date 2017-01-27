<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $fillable = ['ci', 'full_name', 'phone', 'address'];

    public function registers()
    {
    	return $this->hasMany('Roscio\Register', 'person_id');
    }

    public function scopeCi($query, $cedula)
    {
        if (trim($cedula) != '')
        {
            $query->where('ci', "LIKE", "%$cedula%");
        }
    }
    public function scopeName($query, $nombre)
    {
        if (trim($nombre) != '')
        {
            $query->where('full_name', "LIKE", "%$nombre%");
        }
    }
}

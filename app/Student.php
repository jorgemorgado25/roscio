<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Student extends Model
{
    protected $table = "students";
    protected $fillable = ['ci', 'full_name', 'birthday', 'birth_place', 'gender'];

    public function registers()
    {
    	return $this->hasMany('Roscio\Register', 'student_id');
    }

    public function entradas()
    {
        return $this->hasMany('Roscio\Entradas', 'student_id');
    }

    public function getGeneroAttribute()
    {
    	return ($this->gender == 'M' ? 'Masculino' : 'Femenino');
    }
    public function getFechaNacAttribute()
    {
    	$fecha = Carbon::parse($this->birthday);
        return $fecha->format('d-m-Y');
    }
    public function setBirthdayAttribute($valor)
    {
        $ano = substr($valor, 6, 4);
        $mes = substr($valor, 3, 2);
        $dia = substr($valor, 0, 2);
        $fecha = $ano . '-' . $mes . '-' . $dia;
        $this->attributes['birthday'] = $fecha;
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

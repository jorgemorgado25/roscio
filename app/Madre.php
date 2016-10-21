<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Madre extends Model
{
    protected $table = "personas";

    protected $fillable = [
		'cedula', 'nombre', 'apellido', 'genero', 'fecha_nac', 'telefono', 'email', 'profesion', 'grado_instruccion', 'direccion', 'difunto' 
	];

	public function estudiantes()
	{
		return $this->hasMany('Roscio\Estudiante', 'madre_id');
	}
	
	public function setFechaNacAttribute($valor)
	{
		$ano = substr($valor, 6, 4);
        $mes = substr($valor, 3, 2);
        $dia = substr($valor, 0, 2);
        $fecha = $ano . '-' . $mes . '-' . $dia;
		$this->attributes['fecha_nac'] = $fecha; 
	}

	public function getFechaNormalAttribute()
    {
        $ano = substr($this->fecha_nac, 0, 4);
        $mes = substr($this->fecha_nac, 5, 2);
        $dia = substr($this->fecha_nac, 8, 2);
        return $dia . '/' . $mes .'/' . $ano;
    }

    public function getEsDifuntaAttribute()
    {
    	return $this->difunto ? 'SÍ' : 'NO';
    }
	
}

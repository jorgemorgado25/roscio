<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{

	protected $fillable = [
		'madre_id', 'padre_id', 'cedula', 'nombre', 'apellido', 'genero', 'fecha_nac', 'estado_nac', 'talla', 'peso', 'grupo_sanguineo', 'enf_aler', 'vive_con_madre', 'vive_con_padre', 'representante'
	];

    public function madre()
    {
    	return $this->belongsTo('Roscio\Madre', 'madre_id');
    }

    public function padre()
    {
    	return $this->belongsTo('Roscio\Padre', 'padre_id');
    }

    public function representantes()
    {
    	return $this->hasMany('Roscio\Representante', 'estudiante_id');
    }

    public function inscripciones()
    {
        return $this->hasMany('Roscio\Inscripcion', 'estudiante_id');
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

    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getGeneroNormalAttribute()
    {
        return $this->genero == 'm' ? 'MASCULINO' : 'FEMENINO';
    }

    public function getViveConLaMadreAttribute()
    {
        return $this->vive_con_madre ? 'SÍ' : 'NO';
    }

    public function getViveConElPadreAttribute()
    {
        return $this->vive_con_padre ? 'SÍ' : 'NO';
    }

    public function scopeCedula($query, $cedula)
    {
        if( trim($cedula) != '')
        {
            $query->where('cedula', "LIKE", "%$cedula%");
        }
    }
    public function scopeNombre($query, $nombre)
    {
        if( trim($nombre) != '')
        {
            $query->where(\DB::raw("CONCAT(nombre, ' ', apellido)"), "LIKE", "%$nombre%");
        }
    }
}

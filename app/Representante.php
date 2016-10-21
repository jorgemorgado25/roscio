<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    protected $orderBy = ['id', 'desc'];
    protected $table = 'representantes';

    protected $fillable = [
    	'persona_id', 'alumno_id', 'parentesco', 'autorizacion'
    ];

    public function estudiante()
    {
    	return $this->belongsTo('Roscio\Estudiante', 'estudiante_id');
    }

    public function persona()
    {
    	return $this->belongsTo('Roscio\Persona', 'persona_id');
    }

    public function inscripciones()
    {
        return $this->hasMany('Roscio\Inscripcion', 'representante_id');
    }

    public function getPresentaAutorizacionAttribute()
    {
        return $this->autorizacion ? 'SÍ' : 'NO';
    }

    public function scopeIdDesc($query)
    {
        return $query->orderBy('id','DESC');
    }
}

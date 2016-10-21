<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = "inscripciones";
    protected $fillable = ['escolaridad_id', 'representante_id', 'estudiante_id', 'mencion_id', 'ano_id', 'seccion_id'];

    public function estudiante()
    {
    	return $this->belongsTo('Roscio\Estudiante', 'estudiante_id');
    }
    public function escolaridad()
    {
    	return $this->belongsTo('Roscio\Escolaridad', 'escolaridad_id');
    }
    public function mencion()
    {
    	return $this->belongsTo('Roscio\Mencion', 'mencion_id');
    }
    public function ano()
    {
    	return $this->belongsTo('Roscio\Ano', 'ano_id');
    }
    public function seccion()
    {
    	return $this->belongsTo('Roscio\Seccion', 'seccion_id');
    }
    public function representante()
    {
        return $this->belongsTo('Roscio\Representante', 'representante_id');
    }
}

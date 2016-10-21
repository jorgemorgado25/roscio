<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Ano extends Model
{
    protected $table = "anos";
    protected $fillable = ['ano'];

    public function mencion()
    {
    	return $this->belongsTo('Roscio\Mencion', 'mencion_id');
    }

    public function secciones()
    {
    	return $this->hasMany('Roscio\Seccion', 'ano_id');
    }

    public function inscripciones()
    {
        return $this->hasMany('Roscio\Inscripcion', 'ano_id');
    }
}

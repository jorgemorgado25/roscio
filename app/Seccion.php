<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table = 'secciones';
    protected $fillable = ['seccion'];

    public function ano()
    {
    	return $this->belongsTo('Roscio\Ano', 'ano_id');
    }

    public function inscripciones()
    {
        return $this->hasMany('Roscio\Inscripcion', 'seccion_id');
    }
}

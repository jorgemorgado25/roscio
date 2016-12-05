<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = "entradas";

    protected $fillable = [
    	'tipo_ingreso_id', 
    	'student_id', 
    	'mencion_id', 
    	'escolaridad_id', 
    	'ano_id', 
    	'seccion_id'];

    public function student()
    {
    	return $this->belongsTo('Roscio\Student', 'ano_id');
    }
}

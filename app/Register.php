<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
	protected $table = "registers";
	
	protected $fillable = [
		'student_id', 
		'person_id', 
		'escolaridad_id', 
		'mencion_id', 
		'ano_id', 
		'seccion_id'];

    public function student()
    {
    	return $this->belongsTo('Roscio\Student', 'student_id');
    }

    public function person()
    {
    	return $this->belongsTo('Roscio\Person', 'person_id');
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
}

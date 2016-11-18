<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Escolaridad extends Model
{
    protected $table = 'escolaridades';
    protected $fillable = ['escolaridad', 'active'];

    public function inscripciones()
    {
        return $this->hasMany('Roscio\Inscripcion', 'escolaridad_id');
    }

    public function registers()
    {
        return $this->hasMany('Roscio\Register', 'escolaridad_id');
    }

    public function scopeOrderIdDesc($query)
    {
    	return $query->orderBy('id', 'desc');
    }
}

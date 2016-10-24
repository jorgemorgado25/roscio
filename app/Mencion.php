<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Mencion extends Model
{
    protected $table = "menciones";
    protected $fillable = ["mencion"];

    public function anos()
    {
    	return $this->hasMany('Roscio\Ano', 'mencion_id');
    }

    public function inscripciones()
    {
        return $this->hasMany('Roscio\Inscripcion', 'mencion_id');
    }
}

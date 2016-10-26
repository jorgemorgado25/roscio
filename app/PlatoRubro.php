<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class PlatoRubro extends Model
{
    protected $table = 'plato_rubro';
    protected $fillable = ['plato_id', 'rubro_id', 'gramos'];

    public function plato()
    {
    	return $this->belongsTo('\Roscio\Plato', 'plato_id');
    }
    public function rubro()
    {
    	return $this->belongsTo('\Roscio\Rubro', 'rubro_id');
    }
}

<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    protected $table =  "rubros";

    public function categoriaRubro()
    {
    	return $this->belongsTo('Roscio\CategoriaRubro', 'categoria_rubro_id');
    }
}
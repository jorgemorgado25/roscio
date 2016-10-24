<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    protected $table = 'platos';

    public function categoriaPlato()
    {
    	return $this->belongsTo('Roscio\CategoriaPlato', 'categoria_plato_id');
    }
}
<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class CategoriaPlato extends Model
{
    protected $table = 'categoria_platos';

    public function platos()
    {
    	return $this->hasMany('Roscio\Plato', 'categoria_plato_id');
    }
}

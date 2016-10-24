<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class CategoriaRubro extends Model
{
    protected $table = 'categoria_rubros';

    public function rubros()
    {
    	return $this->hasMany('Roscio\Rubro', 'categoria_rubro_id');
    }
}

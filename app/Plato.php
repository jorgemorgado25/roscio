<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    protected $table = 'platos';
    protected $fillable = ['plato', 'categoria_plato_id'];

    public function categoriaPlato()
    {
    	return $this->belongsTo('Roscio\CategoriaPlato', 'categoria_plato_id');
    }

    public function platoRubro()
    {
    	return $this->hasMany('Roscio\PlatoRubro', 'plato_id');
    }

    public function menus()
    {
        return $this->hasMany('Roscio\Menu', 'plato_id');
    }
}
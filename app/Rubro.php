<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    protected $table =  "rubros";
    protected $fillable = ['categoria_rubro_id', 'rubro'];

    public function categoriaRubro()
    {
    	return $this->belongsTo('Roscio\CategoriaRubro', 'categoria_rubro_id');
    }

    public function platoRubro()
    {
    	return $this->hasMany('Roscio\PlatoRubro', 'rubro_id');
    }
}
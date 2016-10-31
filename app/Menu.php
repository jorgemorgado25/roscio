<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['categoria_plato_id', 'cantidad', 'fecha'];

    public function Plato()
    {
    	return $this->belongsTo('Roscio\Plato', 'plato_id');
    }
}

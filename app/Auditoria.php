<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Auditoria extends Model
{
    protected $table = "auditorias";

    protected $fillable = [
    	'user_id', 
    	'description', 
    	'action', 
    	'resource'];

    public function user()
    {
    	return $this->belongsTo('Roscio\User', 'user_id');
    }

    public function getFechaAttribute()
    {
        $fecha = new Carbon($this->created_at);
        return $fecha->format('d-m-Y - h:m:s');
    }
}

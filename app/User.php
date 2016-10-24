<?php

namespace Roscio;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

#AGREGO SOFT DELETE
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'login', 
        'password', 
        'active', 
        'role',
        'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    #Relación con roles
    public function roles()
    {
        return $this->belongsToMany('Roscio\Role', 'user_role', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach ($roles as $role)
            {
                if($this->hasRole($role))
                {
                    return true;
                }
            }
        }else
        {
            if($this->hasRole($roles))
            {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first())
        {
            return true;
        }
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getIsActiveAttribute()
    {
        return ($this->active ? 'Sí' : 'No');
    }

    public function SetPasswordAttribute($valor)
    {
        if( ! empty($valor))
        {
            //$this->attributes['password'] = \Hash::make($valor);
            $this->attributes['password'] = bcrypt($valor);
        }
    }    

    #Creo este atributo para determinadar si es administrador
    public function getIsAdminAttribute()
    {
        /*if($this->role == 'admin')
        {
            return true;
        }*/
        return ($this->role == 'admin' ? true : false);
    }
}

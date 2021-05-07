<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    const CREATED_AT = 'TglRecord';
    const UPDATED_AT = 'TglUpdate';

    protected $table = 'RfUser';
    protected $primaryKey = 'IdUser';
    public $incrementing = false;

    public function username()
    {
        return 'UserLogin';
    }

    public function getAttribute($key)
    {
        return parent::getAttribute(Str::studly($key));
    }

    public function setAttribute($key, $value)
    {
        return parent::setAttribute(Str::studly($key), $value);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'IdRole');
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role->Nama == $role;
        }

        return $role->contains($this->role);
    }
}

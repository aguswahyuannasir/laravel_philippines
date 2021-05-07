<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends  BaseModel
{
    protected $table = 'RfPermission';
    protected $primaryKey = 'IdPermission';

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'RfRolePermission', 'IdPermission', 'IdRole', 'IdPermission');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'RfRole';
    protected $primaryKey = 'IdRole';

    public $timestamps = false;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'RfRolePermission', 'IdRole', 'IdPermission');
    }

    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
}

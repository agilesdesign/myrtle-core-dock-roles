<?php

namespace Myrtle\Core\Roles\Models\Traits;

use Myrtle\Roles\Models\Role;

trait Roleable
{
    public function roles()
    {
        return $this->morphToMany(Role::class, 'roleable');
    }

    protected function getAllRolesAttribute()
    {
        return $this->roles->merge($this->inheritedRoles);
    }

    protected function getInheritedRolesAttribute()
    {
        return Role::userInherits()->get();
    }
}
<?php

namespace Myrtle\Core\Roles\Models\Observers;

use Myrtle\Roles\Models\Role;

class SacredRoleObserver
{
    public function deleting(Role $role)
    {
        if(collect([1,2,3])->contains($role->id))
        {
            flasher()->alert($role->name . ' is a protected role and cannot be removed.', 'danger');
            return false;
        }
    }
}

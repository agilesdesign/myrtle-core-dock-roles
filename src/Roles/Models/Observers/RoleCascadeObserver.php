<?php

namespace Myrtle\Core\Roles\Models\Observers;

use Myrtle\Roles\Models\Role;

class RoleCascadeObserver
{
    public function deleting(Role $role)
    {
        $method = $role->isForceDeleting() ? 'forceDelete' : 'delete';

        if ($method === 'forceDelete')
        {
            $role->permissions()->sync([]);
            $role->users()->sync([]);
        }
    }
}

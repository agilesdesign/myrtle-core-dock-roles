<?php

namespace Myrtle\Core\Docks;

use Myrtle\Roles\Models\Role;
use Myrtle\Roles\Policies\RolesPolicy;

class RolesDock extends Dock
{
    /**
     * Description for Dock
     *
     * @var string
     */
    public $description = 'User Role management';

    /**
     * Explicit Gate definitions
     *
     * @var array
     */
    public $gateDefinitions = [
        'roles.admin' => RolesPolicy::class . '@admin',
        'roles.access.admin' => RolesPolicy::class . '@accessAdmin'
    ];

    /**
     * Policy mappings
     *
     * @var array
     */
    public $policies = [
        Role::class => RolesPolicy::class,
        RolesPolicy::class => RolesPolicy::class,
    ];

    /**
     * List of config file paths to be loaded
     *
     * @return array
     */
    public function configPaths()
    {
        return [
            'docks.' . self::class => dirname(__DIR__, 3) . '/config/docks/roles.php',
            'abilities' => dirname(__DIR__, 3) . '/config/abilities.php',
        ];
    }

    /**
     * List of migration file paths to be loaded
     *
     * @return array
     */
    public function migrationPaths()
    {
        return [
            dirname(__DIR__, 3) . '/database/migrations',
        ];
    }

    /**
     * List of routes file paths to be loaded
     *
     * @return array
     */
    public function routes()
    {
        return [
            'admin' => dirname(__DIR__, 3) . '/routes/admin.php',
        ];
    }
}

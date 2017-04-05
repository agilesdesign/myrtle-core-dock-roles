<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
	protected $roles = [
		['name' => 'Root', 'slug' => 'root'],
		['name' => 'Public', 'slug' => 'public'],
		['name' => 'Registered', 'slug' => 'registered'],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->roles)->each(function($item, $key) {
			Myrtle\Core\Roles\Models\Role::create($item);
		});
    }
}

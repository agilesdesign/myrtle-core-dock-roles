<?php

namespace Myrtle\Core\Roles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Myrtle\Roles\Models\Observers\RoleCascadeObserver;
use Myrtle\Roles\Models\Observers\SacredRoleObserver;
use Myrtle\Users\Models\User;
use Myrtle\Permissions\Models\Traits\Permissionable;

class Role extends Model
{
	use Permissionable, SoftDeletes;

    protected $fillable = ['name', 'slug'];

    public static function boot()
    {
        parent::boot();

        self::observe(RoleCascadeObserver::class);
        self::observe(SacredRoleObserver::class);
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'roleable');
    }

	public function scopeUserInherits($query)
    {
        return $query->whereIn('id', [2,3]);
    }

    public function scopeAssignable($query)
    {
        return $query->whereNotIn('id', [2,3]);
    }

    public function scopePermissionable($query)
    {
        return $query->whereNotIn('id', [1]);
    }

    public function getIsUserAssignableAttribute()
    {
        return self::assignable()->get()->contains(function($role, $key) {
            return $role->id === $this->id;
        });
    }
}

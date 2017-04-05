<?php

namespace Myrtle\Core\Roles\Http\Controllers\Administrator;

use Flasher\Support\Notifier;
use Illuminate\Http\Request;
use Myrtle\Roles\Models\Role;
use Myrtle\Users\Models\User;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate();

        return view('admin::roles.index')->withRoles($roles);
    }

    public function show(Role $role)
    {
        return view('admin::roles.show')->withRole($role);
    }

    public function create(Role $role)
    {
        return view ('admin::roles.create')->withRole($role);
    }

    public function store(Request $request, Role $role)
    {
        Role::create($request->toArray());

        flasher()->alert('Role created successfully', Notifier::SUCCESS);

        return redirect(route('admin.roles.index'));
    }

    public function edit(Role $role)
    {
        $users = User::all()->keyBy('id')->map(function($user, $key) {
            return '(#' . $user->id . ')' . ' ' . $user->name->lastFirst;
        })->toArray();

        $members = $role->users->pluck('id')->toArray();

        return view('admin::roles.edit')
            ->withRole($role)
            ->withUsers($users)
            ->withMembers($members);
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->toArray());

        $role->users()->sync($request->users ?? []);

        flasher()->alert('Role updated successfully', Notifier::SUCCESS);

        return redirect(route('admin.roles.index'));
    }

    public function destroy(Request $request, Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        flasher()->alert('Role removed successfully', Notifier::SUCCESS);

        return redirect(route('admin.roles.index'));
    }
}

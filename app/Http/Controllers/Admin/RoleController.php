<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleSaveRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $isGeneral = $request->is_general;
        $roles = Role::when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
            ->when($isGeneral, fn ($query) => $query->where('is_general', ($isGeneral == 'true') ? 1 : 0))
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return Inertia::render('Admin/Roles/Index', [
            'roles' => $roles
        ]);
    }
    public function edit(Role $role)
    {
        return Inertia::render('Admin/Roles/Edit', [
            'role' => $role
        ]);
    }
    public function update(Role $role, RoleSaveRequest $request)
    {
        // return redirect()->back()->withSuccess('okkok');
        $role->name = $request->name;
        $role->is_general = $request->is_general == 'true';
        $role->save();
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        return Inertia::render('Admin/Roles/Create');
    }

    public function store(RoleSaveRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->is_general = $request->is_general == 'true';
        $role->save();
        return redirect()->route('admin.roles.index')->withSuccess('Успешно добавлено');
    }
    
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}

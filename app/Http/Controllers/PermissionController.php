<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::withCount('users')->latest()->get();

        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:permissions', 'regex:/^[a-z0-9\-]+$/'],
            'display_name' => ['required', 'string', 'max:255'],
        ]);

        Permission::create(['name' => $validated['name']]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permissão criada com sucesso.');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));

    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('permissions')->ignore($permission->id), 'regex:/^[a-z0-9\-]+$/'],
        ]);

        $permission->update(['name' => $validated['name']]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permissão atualizada com sucesso.');
    }

    public function destroy(Permission $permission)
    {
        if ($permission->users()->count() > 0) {
            return back()->with('error', 'Não é possível excluir uma permissão em uso.');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permissão removida com sucesso.');
    }
}

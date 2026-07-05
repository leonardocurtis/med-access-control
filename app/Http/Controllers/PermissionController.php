<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:permissions',
                'regex:/^[a-z0-9\-]+$/',
            ],
            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        Permission::create($validated);

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
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('permissions')->ignore($permission),
                'regex:/^[a-z0-9\-]+$/',
            ],
            'description' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $permission->update($validated);

        return redirect()->route('permissions.index')
            ->with('success', 'Permissão atualizada com sucesso.');
    }

    public function destroy(Permission $permission)
    {
        if ($permission->users()->exists()) {
            return back()->with('error', 'Não é possível excluir uma permissão em uso.');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permissão removida com sucesso.');
    }
}

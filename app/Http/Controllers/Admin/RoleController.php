<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Routing\Controller;
use App\Enum\PermissionsEnum;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'permission:' . implode('|', [
                PermissionsEnum::view_role->value,
                PermissionsEnum::edit_role->value,
                PermissionsEnum::delete_role->value,
                PermissionsEnum::create_role->value,
            ])
        ])->only('index');

        $this->middleware(['permission:' . PermissionsEnum::view_role->value])->only('show');

        $this->middleware(['permission:' . PermissionsEnum::create_role->value])->only('create');

        $this->middleware(['permission:' . PermissionsEnum::edit_role->value])->only('edit');

        $this->middleware(['permission:' . PermissionsEnum::delete_role->value])->only('destroy');

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'desc');

        $roles = Role::withCount('users')
            ->with('permissions')
            ->orderBy('created_at', $sort)
            ->paginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);


        $permissions = $request->input('permissions'); // array of permission IDs
        // Get all other roles and compare
        $roles = Role::with('permissions')->get();

        // to compare between roles permissions and this request role permissions
        foreach ($roles as $role) {
            $rolePermissionIds = $role->permissions->pluck('id')->sort()->values(); //collection
            $requestPermissionIds = collect($permissions)->sort()->values(); //collection

            if ($rolePermissionIds == $requestPermissionIds) {
                return back()->with([
                    'error' => 'Another role already has the same permissions.',
                ]);
            }
        }


        $role = Role::create(['name' => $request->name]);

        // Convert permission IDs to integers and sync
        $permissionIds = array_map('intval', $request->permissions);
        $role->syncPermissions($permissionIds);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if ($role->name == 'Super Admin' || $role->permissions->count() == Permission::count()) {
            return back()->with('error', "cann't edit (Super Admin) role ");
        }

        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);



        $permissions = $request->input('permissions'); // array of permission IDs
        // Get all other roles and compare
        $roles = Role::with('permissions')->get();

        // to compare between roles permissions and this request role permissions
        foreach ($roles as $role) {
            $rolePermissionIds = $role->permissions->pluck('id')->sort()->values(); //collection
            $requestPermissionIds = collect($permissions)->sort()->values(); //collection

            if ($rolePermissionIds == $requestPermissionIds) {
                return back()->with([
                    'error' => 'Another role already has the same permissions.',
                ]);
            }
        }



        if ($role->name != $request->name)
            $role->update(['name' => $request->name]);

        // Convert permission IDs to integers and sync
        $permissionIds = array_map('intval', $request->permissions);
        $role->syncPermissions($permissionIds);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->name == 'Super Admin' && $role->permissions->count() == Permission::count()) {
            return redirect(route('admin.roles.index'))
                ->with('error', "cann't delete (Super Admin) role ");
        }

        // Check if role has users
        if ($role->users()->count() > 0) {
            return redirect(route('admin.roles.index'))
                ->with('error', "Cannot delete role because it has users assigned to it. Please reassign or delete the users first.");
        }

        $role->delete();
        return redirect(route('admin.roles.index'))
            ->with('success', 'Role deleted successfully');
    }
}

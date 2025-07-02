<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use Illuminate\Routing\Controller;
use App\Enum\PermissionsEnum;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'permission:' . implode('|', [
                PermissionsEnum::view_user->value,
                PermissionsEnum::edit_user->value,
                PermissionsEnum::delete_user->value,
                PermissionsEnum::create_user->value,
            ])
        ])->only('index');

        $this->middleware(['permission:' . PermissionsEnum::view_user->value])->only('show');

        $this->middleware(['permission:' . PermissionsEnum::create_user->value])->only('create');

        $this->middleware(['permission:' . PermissionsEnum::edit_user->value])->only('edit');

        $this->middleware(['permission:' . PermissionsEnum::delete_user->value])->only('destroy');

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'desc');
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }


        $users = $query->where('id', "!=", Auth::user()->id)->
            orderBy('created_at', $sort)
            ->with('roles')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'confirmed'],
        ]);
        // dd($attributes);

        $user = User::create(['name' => $attributes['name'], 'email' => $attributes['email'], 'password' => $attributes['password']]);

        $user->syncRoles((int) $attributes['role_id']);

        return redirect()->route('admin.users.index')->with('success', 'تم إنشاء المستخدم بنجاح');


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view(
            'admin.users.edit',
            [
                'user' => $user,
                'roles' => $roles
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', "unique:users,email,$user->id"],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'confirmed'],
        ]);

        unset($attributes['role_id']);

        // dd($attributes);

        $user->update($attributes);

        //check if the user role_id (not equal) the selected role_id
        if ($user->roles()->first()->id != $request['role_id'])
            $user->syncRoles((int) $request['role_id']);


        return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // if the to delete user is super admin [and] the Auth user not super admin cann't delete th user
        if ($user->roles->first()->id == 3 && Auth::user()->roles->first()->id != 3) {
            back()->with('error', 'لا يمكنك حذف هذا المستخدم');
        }


        // User::find($user->id)->delete();
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}

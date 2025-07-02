<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

    return view('admin.index', [
            'usersCount' => \App\Models\User::count(),
            'rolesCount' => \Spatie\Permission\Models\Role::count(),
            'blogsCount' => \App\Models\Blog::count(),
            'doctorsCount' => \App\Models\Doctor::count(),
            'departmentsCount' => \App\Models\Department::count(),
            'specialCasesCount' => \App\Models\SpecialCase::count(),
        ]);
    }
}

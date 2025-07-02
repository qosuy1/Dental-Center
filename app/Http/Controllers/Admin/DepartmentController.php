<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;

use Illuminate\Http\Request;
use App\Enum\PermissionsEnum;
use App\Services\ServiceService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    use uploadImageTrait;

    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {

        $this->serviceService = $serviceService;

        $this->middleware([
            'permission:' . implode('|', [
                PermissionsEnum::view_department->value,
                PermissionsEnum::edit_department->value,
                PermissionsEnum::delete_department->value,
                PermissionsEnum::create_department->value,
            ])
        ])->only('index');

        $this->middleware(['permission:' . PermissionsEnum::view_department->value])->only('show');

        $this->middleware(['permission:' . PermissionsEnum::create_department->value])->only('create');

        $this->middleware(['permission:' . PermissionsEnum::edit_department->value])->only('edit');

        $this->middleware(['permission:' . PermissionsEnum::delete_department->value])->only('destroy');

    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'desc');


        $query = Department::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $departments = $query->with(['doctors', 'services'])
            ->orderBy('created_at', $sort)
            ->simplePaginate(10, ['id', 'name',]);

        return view('admin.departments.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'icon' => 'string|required',
                'name' => "string|required",
                'smallDesc' => ['required', 'string'],
                'services' => ['required', 'string']
            ]
        );

        $validated = $request->only([ 'name', 'smallDesc' , 'icon']);


        //create the department
        if (Department::where('name', "{$validated['name']}")->exists()) {
            return redirect()->route('admin.departments.create')->with('error', 'القسم موجود بالفعل');
        }


        $department = Department::create($validated);
        Cache::forget('departmetns_names');
        Cache::rememberForever('departmetns_names', fn() => Department::pluck('name')->toArray());

        //create the department services
        $this->serviceService->createService($request, $department);

        return redirect()->route('admin.departments.index')->with('success', 'تمت إضافة القسم بنجاح');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $stringServices = $this->serviceService->getDepartmentServicesToedit($department);

        // dd($stringServices);

        return view('admin.departments.edit', compact(['department', 'stringServices']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate(
            [
                // 'image' => [File::types(['png', 'jpg', 'webp', 'jpeg', 'gif'])->max(2048)],
                'name' => "required",
                'smallDesc' => ['required', 'string'],
                'services' => ['required', 'string']
            ]
        );

        $validated = $request->only([ 'name', 'smallDesc']);


        //check if any department have the same name
        if (Department::where('name', "{$validated['name']}")->where('id', '!=', $department->id)->exists()) {
            return redirect()->route('admin.departments.edit', $department->id)->with('error', 'القسم موجود بالفعل');
        }


        $department->update($validated);
        Cache::forget('departmetns_names');
        Cache::rememberForever('departmetns_names', fn() => Department::pluck('name')->toArray());


        $this->serviceService->createService($request, $department);

        return redirect()->route('admin.departments.index')->with('success', 'تم تحديث القسم بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->services()->delete();

        $department->delete();

        return redirect()->route('admin.departments.index')
            ->with([
                'success' => "تم حذف القسم بنجاح",
            ]);
    }
}

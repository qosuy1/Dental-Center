<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\SpecialCase;
use Illuminate\Http\Request;
use App\Enum\PermissionsEnum;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SpecialCaseRequest;
use App\Services\SpecialCaseService;

class SpecialCaseController extends Controller
{
    use uploadImageTrait;

    protected $specialCaseService;

    public function __construct(SpecialCaseService $specialCaseService)
    {

        $this->specialCaseService = $specialCaseService;


        $this->middleware([
            'permission:' . implode('|', [
                PermissionsEnum::view_case->value,
                PermissionsEnum::edit_case->value,
                PermissionsEnum::delete_case->value,
                PermissionsEnum::create_case->value,
            ])
        ])->only('index');

        $this->middleware(['permission:' . PermissionsEnum::view_case->value])->only('show');

        $this->middleware(['permission:' . PermissionsEnum::create_case->value])->only('create');

        $this->middleware(['permission:' . PermissionsEnum::edit_case->value])->only('edit');

        $this->middleware(['permission:' . PermissionsEnum::delete_case->value])->only('destroy');

    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SpecialCase::query();

        // sort
        $sort = $request->input('sort', 'desc');
        // search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        //fillter by cases type
        if ($request->has('casesType') && $request->input('casesType') != 'allCases') {
            $casesType = $request->input('casesType');
            $query->where('is_special_case', $casesType);

        } else
            $query->whereIn('is_special_case', [0, 1]);



        $specialCases = $query->with('doctor')
            ->orderBy('created_at', $sort)
            ->paginate(10);

        return view('admin.special-cases.index', compact('specialCases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::all();
        return view('admin.special-cases.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecialCaseRequest $request)
    {
        $attributes = $request->validated();

        // $attributes['is_special_case'] = $request->has('is_special_case') ? 1 : 0;

        // $attributes['before_image'] = $this->uploadImage($request, null, 'cases/before_images', 'before_image');
        // $attributes['after_image'] = $this->uploadImage($request, null, 'cases/after_images', 'after_image');

        // SpecialCase::create($attributes);

        $attributes['is_special_case'] = $request->has('is_special_case') ? 1 : 0;

        //create special case
        $this->specialCaseService->createSpecialCase($attributes);

        return redirect()->route('admin.special-cases.index')->with('success', "تمت إضافة حالة بنجاح");

    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialCase $specialCase)
    {
        return view('admin.special-cases.show', compact('specialCase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialCase $specialCase)
    {
        $doctors = Doctor::get(['id', 'name']);
        return view("admin.special-cases.edit", compact("specialCase", 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpecialCaseRequest $request, SpecialCase $specialCase)
    {
        $attributes = $request->validated();

        $attributes['is_special_case'] = $request->has('is_special_case') ? 1 : 0;

        // dd($attributes);

        $attributes['before_image'] = $this->uploadImage($request, $specialCase, 'cases/before_images', 'before_image');
        $attributes['after_image'] = $this->uploadImage($request, $specialCase, 'cases/after_images', 'after_image');

        $attributes['doctor_name'] = Doctor::find($attributes['doctor_id'])->name;

        $specialCase->update($attributes);

        return redirect()->route('admin.special-cases.index')->with('success', "تمت تعديل الحالة بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialCase $specialCase)
    {
        $this->specialCaseService->deleteCaseWithImages($specialCase);

        return redirect()->route('admin.special-cases.index')->with([
            'success' => 'تم الحذف بنجاح',
        ]);
    }
}

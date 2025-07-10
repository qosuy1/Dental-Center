<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\Department;
// use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Enum\PermissionsEnum;
use App\Services\DoctorService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


/**
 * @method middleware(string|array $middleware, array $options = [])
 */
class DoctorController extends Controller
{
    use uploadImageTrait;

    public function __construct()
    {
        $this->middleware([
            'permission:' . implode('|', [
                PermissionsEnum::view_doctor->value,
                PermissionsEnum::edit_doctor->value,
                PermissionsEnum::delete_doctor->value,
                PermissionsEnum::create_doctor->value,
            ])
        ])->only('index');

        $this->middleware(['permission:' . PermissionsEnum::view_doctor->value])->only('show');

        $this->middleware(['permission:' . PermissionsEnum::create_doctor->value])->only('create');

        $this->middleware(['permission:' . PermissionsEnum::edit_doctor->value])->only('edit');

        $this->middleware(['permission:' . PermissionsEnum::delete_doctor->value])->only('destroy');

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'desc');

        $query = Doctor::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }


        $doctors = $query->with('department')
            ->orderBy('created_at', $sort)
            ->Paginate(10);


        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get(['name', 'id']);
        return view('admin.doctors.create', ['departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'image' => ['required', 'image'],
            'name' => ['required'],
            'experince' => ['required'],
            'department_id' => ['required', 'exists:departments,id'],
            'phone' => ['required', /*'digits_between:10,13'*/],
            'email' => ['email', 'required'],
            'facebook',
            'linkedin'
        ]);

        // upload images
        $imageToUploadArray = $this->uploadImage($request, null, 'doctors/images');
        $attributes['image'] = $imageToUploadArray['imageURL'];
        $attributes['cloudinary_public_id'] = $imageToUploadArray['cloudinary_public_id'];

        Doctor::create($attributes);

        return redirect()->route('admin.doctors.index')->with('success', "تمت إضافة الطبيب بنجاح");

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $departments = Department::get(['name', 'id']);
        return view('admin.doctors.edit', compact(['doctor', 'departments']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $attributes = $request->validate([
            'image' => ['nullable', 'image'],
            'name' => ['required'],
            'experince' => ['required'],
            'department_id' => ['required', 'exists:departments,id'],
            'phone' => ['required', /*'digits_between:10,13'*/],
            'email' => ['email', 'required'],
            'facebook',
            'linkedin'
        ]);

        // dd($request->all());

        // upload images
        $imageToUploadArray = $this->uploadImage($request, $doctor, 'doctors/images');
        $attributes['image'] = $imageToUploadArray['imageURL'];
        $attributes['cloudinary_public_id'] = $imageToUploadArray['cloudinary_public_id'];


        $doctor->update($attributes);

        return redirect()->route('admin.doctors.index')->with('success', "تمت تعديل الطبيب بنجاح");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        //delete doctor image
        // if (file_exists('storage/' . $doctor->image))
        //     Storage::disk('public')->delete($doctor->image);
        // elseif (file_exists(public_path($doctor->image)))
        //     unlink(public_path($doctor->image));
        if ($doctor->cloudinary_public_id) {
            Cloudinary::destroy($doctor->cloudinary_public_id);
        }

        return redirect()->route('admin.doctors.index')
            ->with([
                'success' => "تم حذف الطبيب بنجاح",
            ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Enum\PermissionsEnum;

use App\Jobs\ProcessDeleteImage;
use App\Jobs\ProcessImageUploade;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BlogController extends Controller
{
    use uploadImageTrait;

    public function __construct()
    {
        $this->middleware([
            'permission:' . implode('|', [
                PermissionsEnum::view_blog->value,
                PermissionsEnum::edit_blog->value,
                PermissionsEnum::delete_blog->value,
                PermissionsEnum::create_blog->value,
            ])
        ])->only('index');

        $this->middleware(['permission:' . PermissionsEnum::view_blog->value])->only('show');

        $this->middleware(['permission:' . PermissionsEnum::create_blog->value])->only('create');

        $this->middleware(['permission:' . PermissionsEnum::edit_blog->value])->only('edit');

        $this->middleware(['permission:' . PermissionsEnum::delete_blog->value])->only('destroy');

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'desc');

        $query = Blog::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $blogs = $query->with('doctor')->orderBy('created_at', $sort)->simplePaginate(5);
        return view('admin.blogs.index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('gggggggggg');
        $doctors = Doctor::get(['id', 'name']);
        return view('admin.blogs.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'smallDesc' => ['required'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'image' => ['required', 'image'],
        ]);



        $attributes['doctor_name'] = Doctor::find($attributes['doctor_id'])->name;
        $attributes['image'] = " ";
        $blog =  Blog::create($attributes);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp_uploads', $filename, 'local'); // storage/app/temp_uploads/xxx.jpg
            $fullPath = storage_path('app/private/' . $path);
            // dd(storage_path('app/' . $path));
            ProcessImageUploade::dispatch($blog, $fullPath, 'blogs/images');
        }

        // dd($attributes);


        return redirect()->route('admin.blogs.index')->with('success', "تمت إضافة المقال بنجاح");
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $doctors = Doctor::get(['id', 'name']);
        return view('admin.blogs.edit', compact(['blog', 'doctors']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {

        $attributes = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'smallDesc' => ['required'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            // 'image' => [File::types(['png', 'jpg', 'webp', 'jpeg', 'gif'])->max(2048)],
            'image' => [File::image()->max(2048)],

        ]);



        $attributes['doctor_name'] = Doctor::find($attributes['doctor_id'])->name;
        $attributes['image'] = " " ;
        $blog->update($attributes);


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp_uploads', $filename, 'local'); // storage/app/temp_uploads/xxx.jpg
            $fullPath = storage_path('app/private/' . $path);
            // dd(storage_path('app/' . $path));
            ProcessImageUploade::dispatch($blog, $fullPath, 'blogs/images');
        }
        // //delete old image
        // if (isset($blog->image) && $blog->image != $attributes['image'])
        //     Storage::disk('public')->delete($blog->image);


        // and presist
        return redirect()->route('admin.blogs.show', $blog)->with('success', "تم تعديل المقال بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        //delete blog image
        // if (file_exists('storage/' . $blog->image))
        //     Storage::disk('public')->delete($blog->image);
        // elseif (file_exists(public_path($blog->image)))
        //     unlink(public_path($blog->image));

        if ($blog->cloudinary_public_id) {
            ProcessDeleteImage::dispatch($blog->cloudinary_public_id);
        }

        return redirect()->route('admin.blogs.index')->with([
            'success' => 'تم الحذف بنجاح',
        ]);
    }




}

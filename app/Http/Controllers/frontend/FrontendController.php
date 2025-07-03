<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Setting;
use App\Models\SpecialCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use PhpParser\Node\Stmt\Case_;

class FrontendController extends Controller
{
    public function index()
    {
        $departments = Department::take(4)->orderBy('created_at')->get();
        $blogs = Blog::with('doctor')->get();

        return view('frontend.index', compact(['departments', 'blogs']));
    }


    public function aboutUs()
    {
        $settings = Setting::all(['google_map_location', 'our_story', 'about_us_image'])->first();
        $doctors = Doctor::simplePaginate(8);
        // dd($settings->google_map_location);
        return view('frontend.about-us', compact(['settings', 'doctors']));
    }

    public function get_department(string $name)
    {
        $department = Department::where('name', '=', $name)->with(['services', 'doctors'])->first();
        $cases = SpecialCase::whereIn('doctor_id', $department->doctors()->pluck('id')->toArray())->simplePaginate(6);


        /**
         * get() return many collection , you cannt do this : $department->services
         * first() return one collection , you can do this : $department->services , because services dor a specific collection
         */
        return view('frontend.department', compact(['department', 'cases']));
    }

    public function cases(Request $request)
    {

        $sort = $request->input('date', 'newest') == 'oldest'  ? 'asc' : 'desc';
        $query = SpecialCase::query();

        if($request->input('caseType') == 'special')
            $query->where('is_special_case' , "=" , 1);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $cases = $query->with('doctor')->orderBy('updated_at', $sort)->simplePaginate(6);

        return view('frontend.cases', compact(['cases']));
    }

    public function caseDetails($id)
    {
        $case = SpecialCase::findOrFail($id);
        // dd($case);
        return view('frontend.case-details', compact('case'));
    }


    public function blogs(Request $request)
    {

        $sort = $request->input('date', 'newest') == 'oldest' ? 'asc' : 'desc';
        $query = Blog::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $blogs = $query->with('doctor')->orderBy('updated_at' , $sort)->simplePaginate(6);

        // $blogs = Blog::with('doctor')->simplePaginate(8);

        return view('frontend.blogs', compact(['blogs']));
    }



    public function blogDetails($id)
    {
        $blog = Blog::findOrFail($id);
        return view('frontend.blog-details', compact('blog'));
    }
}

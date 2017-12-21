<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\CourseCategory;
use Auth;
use DB;
use Session;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //menampilkan katalog kursus
    public function indexStudent(){
    	$user = Auth::user();
        $courses = Course::paginate(5);
        $courseCategories = CourseCategory::all();
        return view('student/course_index', ['user' => $user,
        							'courses' =>  $courses ,
        							'courseCategories' => $courseCategories]);
    }

    //membuat kursus baru untuk teacher
    public function store_teacher(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'title' => 'required',
            'course_category' => 'required'//,
            // 'description' => 'required'
        ]);
         Session::flash('flash_message', 'A course successfully added!');
        $id = DB::table('courses')->insertGetId(
            [
                'user_id' => $user['id'], 
                'course_category_id' => $request->input('course_category'),
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]
        );

        return redirect()->back();
    }


    //menampilkan halaman kursus
    public function show($id){
        $user = Auth::user();
        $course = Course::where("id",$id)->first();
        return view('student/course_show', ['user' => $user,
                                    'course' =>  $course ]);

    }

    // Hasil submit form edit course
    public function update_teacher(Request $request)
    {
        # code...
    }

    //menampilkan katalog kursus bedasarkan kategori
    public function showByCategory($category_id){
        $user = Auth::user();
        $courses = Course::where("course_category_id",$category_id)->paginate(5);
        $courseCategories = CourseCategory::all();
        return view('student/course_index', ['user' => $user,
                                    'courses' =>  $courses ,
                                    'courseCategories' => $courseCategories]);
    }

    //menampilkan halaman untuk mengedit kursus untuk teacher owner kursus
    public function edit_teacher($id)
    {
        $course = Course::find($id);
        $user = Auth::user();
        $courses = DB::table('courses')
                    ->select('courses.id as c_id', 'title', 'user_id', 'description', 'course_categories.name','course_categories.id as cc_id' )
                    ->join('course_categories', 'course_categories.id', '=', 'courses.course_category_id')
                    ->where('courses.id', '=', $id)
                    ->get();
        $cc = DB::table('course_categories')->get();
        // return view('teachers/courses', );
        return view('teachers/courses-edit',['value' => $courses, 'course_cat'=>$cc ,'user'=>$user ]);
    }

    //menghapus kursus untuk teacher owner kursus
     public function delete_teacher($id)
    {
        DB::table('courses')->where('id', '=', $id)->delete();
        Session::flash('flash_message', 'A course successfully deleted!');
        return redirect()->back();
     
    }

       // Laman manajemen session, assignment, dan quiz pada suatu course yang diampu oleh guru 
    public function manage_teacher($s_id)
    {
        $user = Auth::user();
        $course = Course::where("id",$s_id)->first();
        return view('teachers/course-manage', ['user' => $user,
                                    'course' =>  $course ]);
        // $course = Session::where("id",$s_id)->first();
        // return view('student/course_show', ['user' => $user,
        //                             'course' =>  $course ]);        
    }
}

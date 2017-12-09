<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\CourseCategory;
use Auth;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$user = Auth::user();
        $courses = Course::paginate(5);
        $courseCategories = CourseCategory::all();
        return view('courses/course_index', ['user' => $user,
        							'courses' =>  $courses ,
        							'courseCategories' => $courseCategories]);
    }

    public function showByCategory($category_id){
        $user = Auth::user();
        $courses = Course::where("course_category_id",$category_id)->paginate(5);
        $courseCategories = CourseCategory::all();
        return view('courses/course_index', ['user' => $user,
                                    'courses' =>  $courses ,
                                    'courseCategories' => $courseCategories]);
    }
}

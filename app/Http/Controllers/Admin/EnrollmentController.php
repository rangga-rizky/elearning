<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Enrollment;
use App\Course;
use App\Group;
use App\User;
use Validator;

class EnrollmentController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}


	public function index(){
		$user = Auth::user();
		$courses = Course::all();

		return view('admins/enrollment', ['user' => $user,
										'courses' => $courses]);
	}

	public function show($course_id){
		$user = Auth::user();
		$enrolllments = Enrollment::where("course_id",$course_id)->distinct()->get();
		$group_ids = [];
		foreach ($enrolllments as $enrollment) {
			$group_ids[] = $enrollment->group_id;
		}
		$groups = Group::whereNotIn("id",$group_ids)->get();
		$course = Course::find($course_id);
		return view('admins/show_enrollment', ['user' => $user,
										'groups' => $groups,
										'course' => $course]);
	}

	public function store(Request $request){
		$user = Auth::user();		
		$this->validator($request->all())->validate();
		$ids = $request->input('group_id');		
		$course_id = $request->input("course_id");
		foreach ($ids as $id) {
			$enrollment = Enrollment::create([
				'course_id' => $course_id,
				'group_id' => $id
			]);
		}		

		return redirect('admin/enrollments/'.$course_id)->withSuccess('Member is added');
	}

	public function remove(Request $request){
		$course_id = $request->input("course_id");
		$enrollment = Enrollment::find($request->input('id'));
		$enrollment->delete();
		return redirect('admin/enrollments/'.$course_id)->withSuccess('Member is removed');
	}


	protected function validator(array $data)
	{
		return Validator::make($data, [
			'group_id' => 'required',
		]);
	}
}

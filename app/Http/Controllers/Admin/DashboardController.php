<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Course;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $users = User::all();
        $number_of_students = $users->where("role_id",1)->count();
        $number_of_teachers = $users->where("role_id",2)->count();
        $number_of_courses = Course::all()->count();

		return view('admins/admin_dashboard', ['user' => $user,
												'number_of_students' => $number_of_students,
												'number_of_teachers' => $number_of_teachers,
												'number_of_courses' => $number_of_courses]);
    }
}

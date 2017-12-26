<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Grading;
use App\StudentAssingment;
use App\QuizEnrollment;
use PDF;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function show(){
		$user = Auth::user();
		$grades = Grading::where('user_id',$user->id)->get();
		
		$number_finished_assignment = StudentAssingment::where("user_id",$user->id)->count();		
		$number_finished_quiz = QuizEnrollment::where("user_id",$user->id)->count();
		return view('student/profile', ['user' => $user,
										'grades' => $grades,
										'number_finished_assignment' => $number_finished_assignment,
										'number_finished_quiz' => $number_finished_quiz,
										]);

	}


	public function pdf(){
		$user = Auth::user();
		$grades = Grading::where('user_id',$user->id)->get();
		$pdf = PDF::loadView('student.print', ["grades" => $grades,
												"user" => $user]);
		return $pdf->stream('user.pdf');
	}


}

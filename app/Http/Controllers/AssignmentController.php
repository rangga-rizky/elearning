<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assingment;
use App\StudentAssingment;
use Auth;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function showbyUser($assignment_id){
    	$user = Auth::user();
    	$assignment = Assingment::where("id",$assignment_id)->first();
    	$studentAssingment = StudentAssingment::where("user_id",$user->id)->where("assignment_id",$assignment_id)->first();

        $dt = Carbon::parse($assignment['closed_time']);
        $dtUpdatedAt = Carbon::parse($studentAssingment['updated_at']);
        $assignment["remaining"] = $dt->diffForHumans(Carbon::now());
        $assignment['closed_time'] = $dt->formatLocalized('%A %d %B %Y');
        $studentAssingment['updated_at'] =  $dtUpdatedAt->formatLocalized('%A %d %B %Y');
        
        return view('student/assignment', ['user' => $user,
                                    'assignment' =>  $assignment ,
                                    'studentAssingment' => $studentAssingment]);

    }

}

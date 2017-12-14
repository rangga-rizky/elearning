<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentAssingment;
use Auth;

class StudentAssignmentController extends Controller
{
	   public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request){
    	$user = Auth::user();
    	$file = $request->file('file');
    	$assignment_id = $request->input('assignment_id');

    	if(empty($assignment_id) || empty($file) ){
    		return response()->json(['error' => 'true', 'message' => 'data tidak lengkap']);
    	}

    	$filename = $user->id."_".$assignment_id.".".$file->getClientOriginalExtension();
    	$destinationPath = 'file/lessons';
      	$file->move($destinationPath,$filename);


      	$studentAssingment = StudentAssingment::where("user_id",$user->id)->where("assignment_id",$assignment_id)->first();
      	if(!empty($studentAssingment)){
      		$studentAssingment['file_path'] = $destinationPath;
      		$studentAssingment->save();
      	}else{
      		$data['file_path'] = $destinationPath;
      		$data['assignment_id'] = $assignment_id;
			$data['user_id'] = $user->id;
			$studentAssingmentCreated = StudentAssingment::create($data);
      	}

    }
}

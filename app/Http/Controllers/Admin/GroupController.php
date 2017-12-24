<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Group;

class GroupController extends Controller
{
    
    public function __construct()
	{
		$this->middleware('auth');
	}


    public function store(Request $request){
		$user = Auth::user();
		$data["name"] = $request->input("name");
		$userGroup = Group::create([
			'name' => $data['name'],
		]);

		return redirect('admin/user_groups')->withSuccess('Grup Successfully created');
	}
}

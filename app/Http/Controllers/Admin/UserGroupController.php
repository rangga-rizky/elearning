<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\UserGroup;
use App\Group;
use Validator;

class UserGroupController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(){
		$user = Auth::user();
		$groups = Group::all();

		return view('admins/user_group', ['user' => $user,
										'groups' => $groups]);
	}


	public function store(Request $request){
		$user = Auth::user();		
		$this->validator($request->all())->validate();
		$ids = $request->input('user_id');		
		$group_id = $request->input("group_id");
		foreach ($ids as $id) {
			$userGroup = UserGroup::create([
				'group_id' => $group_id,
				'user_id' => $id
			]);
		}		

		return redirect('admin/user_groups/'.$group_id)->withSuccess('Member is added');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'user_id' => 'required',
		]);
	}

	public function show($group_id){
		$user = Auth::user();
		$users = User::NotMember($group_id)->where("role_id",1)->get();
		$group = Group::find($group_id);
		$userGroups = UserGroup::where("group_id",$group_id)->get();
		return view('admins/show_user_group', ['user' => $user,
										'group' => $group,
										'userGroups' => $userGroups,
										'users' => $users]);
	}

	public function remove(Request $request){
		$group_id = $request->input("group_id");
		$userGroup = UserGroup::find($request->input('id'));
		$userGroup->delete();
		return redirect('admin/user_groups/'.$group_id)->withSuccess('Member is removed');
	}





}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Role;
use App\User;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function create(){
		$user = Auth::user();
		$roles = Role::orderBy('id')->pluck('name', 'id');
		return view('admins/create_user', ['user' => $user,
			'roles' => $roles]);
	}

	public function remove(Request $request){
		$user = User::find($request->input('id'));
		$user->delete();
		return redirect('admin/user')->withSuccess($user->username.' behasil di delete!');
	}

	public function index(){
		$user = Auth::user();
		$users = user::all();
		return view('admins/index_user', ['user' => $user,
			'users' => $users]);
	}

	public function show($id){
		$user = Auth::user();
		$user_data = User::find($id); 		
		$roles = Role::orderBy('id')->pluck('name', 'id');
		return view('admins/edit_user', ['user' => $user,
			'user_data' => $user_data,
			'roles' => $roles]);
	}

	public function store(Request $request){
		$this->validator($request->all())->validate();
		$user = $this->create_user($request->all());		
		return redirect('admin/user')->withSuccess('User behasil ditambahkan!');
		

	}

	public function update(Request $request){
		$this->edit_validator($request->all())->validate();
		$user = User::find($request->input('id'));
		$user->username = $request->input('name');
		$user->email = $request->input('email');
		$user->role_id = $request->input('role');
		$user->save();
		return redirect('admin/user')->withSuccess('User behasil di edit!');
		
	}

	public function reset_password(Request $request){

		$user = User::find($request->input('id'));
		$user->password = bcrypt("123456");
		$user->save();
		return redirect('admin/user')->withSuccess('password '.$user->username." berhasil direset menjadi 123456");
	}


	protected function create_user(array $data)
	{
		$user = User::create([
			'username' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'role_id' => $data['role'],
		]);
		return $user;
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'role' => 'required|exists:roles,id'
		]);
	}


	protected function edit_validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'role' => 'required|exists:roles,id'
		]);
	}

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$title = "Quản lý người dùng";
		$users = User::all();
		return view('component.user.index', compact('title', 'users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate(
			[
				'name' => 'required',
				'email' => 'required|unique:users',
				'password' => 'required|min:4',
				'repassword' => 'required'
			],
			[
				'name.required' => 'Tên không được để trống',
				'email.required' => 'Email không được để trống',
				'email.unique' => 'Email đã tồn tại',
				'password.required' => 'Mật khẩu không được để trống',
				'password.min' => 'Mật khẩu tối thiểu 4 ký tự',
				'repassword.required' => 'Vui lòng xác nhận mật khẩu',
			]
		);
		if ($request->password == $request->repassword) {
			$user = new User();
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = Hash::make($request->password);
			$user->save();

			return redirect()->route('user.index')->with('msg', 'Thành công');
		} else {
			return redirect()->route('user.index')->with('err', 'Mật khẩu xác nhận không khớp');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}

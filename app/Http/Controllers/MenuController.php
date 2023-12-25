<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$title = 'Cơ quan, dơn vị';

		$menus = Menu::simplePaginate(25);
		$menu_select = Menu::all();
		return view('component.coquan.index', compact('menus', 'title', 'menu_select'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$title = 'Thêm cơ quan, đơn vị';
		$menus = Menu::all();

		return view('component.coquan.create', compact('title', 'menus'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// dd($request);
		$menu = new Menu();
		$menu->title = $request->title;
		$menu->parent_id = $request->parent_id;
		$menu->save();
		return redirect()->route('menu.index')->with('msg', 'Thành công');
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
		$menu = Menu::find($id);
		$menus = Menu::where('id', '!=', $id)->get();
		$title = "Sửa cơ quan, đơn vị";
		return view('component.coquan.edit', compact('title', 'menu', 'menus'));
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
		$menu = Menu::find($id);
		$menu->title = $request->title;
		$menu->parent_id = $request->parent_id;
		$menu->save();
		return redirect()->route('menu.index')->with('msg', 'Cập nhật thành công');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$menu = Menu::find($id);
		$menu->delete();
		return redirect()->route('menu.index')->with('msg', 'Đã xóa thành công');
	}


	public function getTreeTable()
	{
		$title = "Trang chủ";
		$menuModel = new Menu();

		// Gọi đệ quy
		$menus = $menuModel->getNestedMenus();
		$menuTop = $menuModel::where('parent_id', '0')->get();
		return view('component.dashboard.index', compact('menus', 'title'));
	}

	public function filter(Request $request)
	{
		$title = $request->input('title');
		$parent_id = $request->input('parent_id');

		$canbo = Menu::query();

		if ($title && $title != "") {
			$canbo->where('title', 'LIKE', "%{$title}%");
		}
		if ($parent_id && $parent_id != '0') {
			$canbo->where('parent_id', $parent_id);
		}

		$menus = $canbo->simplePaginate(25)->appends(['title' => $title, 'parent_id' => $parent_id]);

		$menu_select = Menu::all();
		$title = 'Cơ quan, đơn vị';

		return view('component.coquan.index', compact('title', 'menus', 'menu_select'));
	}
}

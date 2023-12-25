<?php

namespace App\Http\Controllers;

use App\Models\Canbo;
use App\Models\DanToc;
use App\Models\Menu;
use App\Models\Tintuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CanboController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$canbo_all = Canbo::simplePaginate(25);
		$title = 'Danh sách cán bộ';
		$menus = Menu::all();
		$dantocs = DanToc::all();

		return view('component.canbo.index', compact('title', 'canbo_all', 'menus', 'dantocs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$title = 'Thêm cán bộ';
		$menus = Menu::all();
		$dantocs = DanToc::all();
		return view('component.canbo.create', compact('title', 'menus', 'dantocs'));
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
		$request->validate(
			[
				'hoten' => 'required|max:255',
				'gioitinh' => 'required',
			]
		);



		$canbo = new Canbo();
		$canbo->hoten = $request->hoten;

		// Có hình ảnh mới xử lý
		if (isset($request->hinhanh) && $request->hinhanh != '') {
			$file = $request->hinhanh;
			$tenhinhanh = Str::of($request->hoten)->slug('_') . '.' . $file->getClientOriginalExtension();
			Storage::disk('canbo')->put($tenhinhanh, File::get($file));
			$canbo->hinhanh = $tenhinhanh;
		}

		$canbo->gioitinh = $request->gioitinh;
		$canbo->ngaysinh = $request->ngaysinh;
		$canbo->dantoc_id = $request->dantoc_id;
		$canbo->quequan = $request->quequan;
		$canbo->chucvu = $request->chucvu;
		$canbo->menu_id = $request->menu_id;
		$canbo->trinhdochuyenmon = $request->trinhdochuyenmon;
		$canbo->liluanchinhtri = $request->liluanchinhtri;
		$canbo->quatrinhcongtac = $request->quatrinhcongtac;
		$canbo->link_search = $request->link_search;
		$canbo->keyword = $request->keyword;
		$canbo->save();
		return redirect()->route('canbo.index')->with('msg', 'Thêm cán bộ thành công');
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
		$canbo = Canbo::find($id);
		$menus = Menu::all();
		$dantocs = DanToc::all();
		$title = "Cập nhật thông tin";
		return view('component.canbo.edit', compact('canbo', 'title', 'menus', 'dantocs'));
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

		$canbo = Canbo::find($id);

		$canbo->hoten = $request->hoten;

		// Có hình ảnh mới xử lý
		if (isset($request->hinhanh) && $request->hinhanh != '') {

			// Xóa ảnh cũ
			$hinhanh_old = $canbo->hinhanh;
			if ($hinhanh_old && $hinhanh_old != '') {
				Storage::disk('canbo')->delete($hinhanh_old);
			}


			// Lưu ảnh mới
			$file = $request->hinhanh;

			$tenhinhanh = Str::of($request->hoten)->slug('_') . '.' . $file->getClientOriginalExtension();;
			Storage::disk('canbo')->put($tenhinhanh, File::get($file));
			$canbo->hinhanh = $tenhinhanh;
		}

		$canbo->gioitinh = $request->gioitinh;
		$canbo->ngaysinh = $request->ngaysinh;
		$canbo->dantoc = $request->dantoc;
		$canbo->quequan = $request->quequan;
		$canbo->chucvu = $request->chucvu;
		$canbo->menu_id = $request->menu_id;
		$canbo->trinhdochuyenmon = $request->trinhdochuyenmon;
		$canbo->liluanchinhtri = $request->liluanchinhtri;
		$canbo->quatrinhcongtac = $request->quatrinhcongtac;
		$canbo->link_search = $request->link_search;
		$canbo->keyword = $request->keyword;
		$canbo->dantoc_id = $request->dantoc_id;
		$canbo->timesearch = '';
		$canbo->save();
		return redirect()->route('canbo.index')->with('msg', 'Đã sửa thành công');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$canbo = Canbo::find($id);
		$hinhanh = $canbo::find($id)->hinhanh;
		if ($hinhanh && $hinhanh != '') {
			Storage::disk('canbo')->delete($hinhanh);
		}

		$tintuc = Tintuc::where('canbo_id', $id);
		$canbo->delete();
		$tintuc->delete();
		return redirect()->route('canbo.index')->with('msg', 'Xóa thành công cán bộ');
	}

	public function getCanBo_byMenuId($menu_id)
	{
		$canbo = Canbo::where('menu_id', $menu_id)->get();
		$menu = Menu::where('id', $menu_id)->first();
		$data = [
			'canbo' => $canbo,
			'menu' => $menu,
		];
		return response()->json($data, 200);
	}

	public function filter(Request $request)
	{
		$menu_id = $request->input('menu_id');
		$gioitinh = $request->input('gioitinh');
		$dantoc_id = $request->input('dantoc_id');
		$hoten = $request->input('hoten');

		$canbo = Canbo::query();

		if ($hoten && $hoten != "") {
			$canbo->where('hoten', 'LIKE', "%{$hoten}%");
		}

		if ($menu_id && $menu_id != '0') {
			$canbo->where('menu_id', $menu_id);
		}
		if ($gioitinh && $gioitinh != '0') {
			$canbo->where('gioitinh', $gioitinh);
		}
		if ($dantoc_id && $dantoc_id != '0') {
			$canbo->where('dantoc_id', $dantoc_id);
		}


		$canbo_all = $canbo->simplePaginate(25)->appends(['hoten' => $hoten, 'menu_id' => $menu_id, 'dantoc_id' => $dantoc_id]);
		// return response()->json($canbo);
		$title = 'Danh sách cán bộ';
		$menus = Menu::all();
		$dantocs = DanToc::all();

		return view('component.canbo.index', compact('title', 'canbo_all', 'menus', 'dantocs'));
	}
}

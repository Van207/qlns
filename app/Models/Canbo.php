<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canbo extends Model
{
	use HasFactory;

	protected $table = 'canbo';
	public $fillable = [
		'hoten', 'ngaysinh', 'gioitinh', 'dantoc', 'quequan', 'chucvu', 'trinhdochuyenmon', 'liluanchinhtri', 'quatrinhcongtac'
	];

	public function dantoc()
	{
		return $this->belongsTo(DanToc::class, 'dantoc_id', 'id');
	}
	public function menu()
	{
		return $this->belongsTo(Menu::class, 'menu_id', 'id');
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	use HasFactory;

	protected $table = 'menu';
	public $fillable = ['title', 'parent_id'];

	public function children()
	{
		return $this->hasMany(Menu::class, 'parent_id', 'id');
	}

	public function parent()
	{
		return $this->belongsTo(Menu::class, 'parent_id', 'id');
	}

	public function getNestedMenus($parentId = 0)
	{
		$menus = $this->where('parent_id', $parentId)->get();

		// Đệ quy
		foreach ($menus as $menu) {
			$menu->children = $this->getNestedMenus($menu->id);
		}

		return $menus;
	}

}

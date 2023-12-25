<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tintuc extends Model
{
	use HasFactory;
	protected $table = 'canbo_thongtin';

	public function canbo()
	{
		return $this->belongsTo(CanBo::class, 'canbo_id');
	}
}

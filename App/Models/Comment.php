<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Comment extends Eloquent {

	protected $fillable = ['title'];

	public function replies()
	{
		return $this->hasMany('Reply');
	}
}
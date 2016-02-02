<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Reply extends Eloquent {

	protected $fillable = ['title','comment_id'];

}
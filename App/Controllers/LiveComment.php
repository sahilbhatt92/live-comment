<?php

namespace App\Controllers;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Comment;
use App\Models\Reply;

class LiveComment
{

	protected $comment = "";
	protected $reply = "";
	
	public function __construct()
	{
		$this->comment = new Comment;
		$this->reply = new Reply;
	}

	public function getComments()
	{
		return $this->comment->orderBy('created_at','DESC')->get();
	}

	public function getLatestComments($created_at)
	{
		return $this->comment->where('created_at', '>', $created_at)->first();
	}

	public function getReplies($id)
	{
		return $this->reply->where('comment_id',$id)->orderBy('created_at','DESC')->get();
	}

	public function getLatestReplies($created_at)
	{
		return $this->reply->where('created_at', '>', $created_at)->first();
	}

	public function getSingleReply($created_at)
	{
		return $this->reply->orderBy('created_at','DESC')->first();
	}

	public function postComments($value = array())
	{
		return $this->comment->create($value);
	}

	public function postReplies($value = array())
	{
		return $this->reply->create($value);
	}
}
<?php

use Illuminate\Database\Capsule\Manager as Capsule;


if(!Capsule::schema()->hasTable('comments'))
{
	Capsule::schema()->create('comments', function($table)
	{
	   $table->increments('id');
	   $table->text('title');
	   $table->timestamps();
	});
}

if(!Capsule::schema()->hasTable('replies'))
{
	Capsule::schema()->create('replies', function($table)
	{
	   $table->increments('id');
	   $table->text('title');
	   $table->integer('comment_id');
	   $table->timestamps();
	});
}

?>
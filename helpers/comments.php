<?php

require '../vendor/autoload.php';
require '../config/database.php';

  $livecomment = (new \App\Controllers\LiveComment);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
     $comment = $livecomment->postComments(['title'=>$_POST['title']]);
     echo '{"id":"'.$comment->id.'", "title":"'.$comment->title.'", "created_at":"'.$comment->created_at.'"}';
}else{
  if(isset($_POST['submit']))
  {
    if($_POST['title'] != "")
    {
      $livecomment->postComments(['title'=>$_POST['title']]);
    }
    header('Location: /');
  }
}

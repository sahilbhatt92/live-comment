<?php

require '../vendor/autoload.php';
require '../config/database.php';

  $livecomment = (new \App\Controllers\LiveComment);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
     $reply = $livecomment->postReplies(['title'=>$_POST['title'],'comment_id'=>$_POST['comment_id']]);
     echo '{"title":"'.$reply->title.'", "created_at":"'.$reply->created_at.'"}';
}else{
  if(isset($_POST['submit2']))
  {
    if($_POST['title'] != "")
    {
      $livecomment->postReplies(['title'=>$_POST['title'],'comment_id'=>$_POST['comment_id']]);
    }
    header('Location: /');
  }
}

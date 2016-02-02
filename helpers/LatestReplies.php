<?php

require '../vendor/autoload.php';
require '../config/database.php';

  $livecomment = (new \App\Controllers\LiveComment);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $reply = $livecomment->getLatestReplies($_POST['created_at']);
      if($reply)
        echo '{"id":"'.$reply->id.'", "title":"'.$reply->title.'", "created_at":"'.$reply->created_at.'", "comment_id":"'.$reply->comment_id.'"}';
}
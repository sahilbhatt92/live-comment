<?php

require '../vendor/autoload.php';
require '../config/database.php';

  $livecomment = (new \App\Controllers\LiveComment);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $comment = $livecomment->getLatestComments($_POST['created_at']);
      if($comment)
        echo '{"id":"'.$comment->id.'", "title":"'.$comment->title.'", "created_at":"'.$comment->created_at.'"}';
}
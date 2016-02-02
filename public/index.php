<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Live Comment System</title>

    <!-- Bootstrap -->
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php 
      $livecomment = (new \App\Controllers\LiveComment);
    ?>
    <input type="hidden" id="lt" value="<?php echo $livecomment->getSingleReply()->created_at; ?>">
    <div class="container">
      <div class="comments-wrap">
        <div class="row">
          <div class="col-lg-6 col-lg-offset-3">
            <div class="comment-post">
              <form id="postComment" class="form-horizontal" action="/helpers/comments.php" method="post">
                  <textarea class="form-control" name="title" id="title" placeholder="What's in your mind ?"></textarea>
                  <button type="submit" name="submit" class="btn btn-primary btn-sm pull-right no-top-border">Comment</button>
              </form>
            </div>
            <div class="clearfix"></div>              
            <!-- Stream Section started -->
            <ul class="media-list comment-list" data-src="/helpers/LatestComments.php">
            <?php foreach($livecomment->getComments() as $comment): ?>
              <li class="media comment-stream" data-timestamps="<?php echo $comment->created_at; ?>">
                <div class="media-left"></div>
                <div class="media-body">
                  <div><?php echo $comment->title; ?></div>
                  <button type="button" class="btn btn-link btn-extended make-reply">Reply</button>
                  <form id="postReply" class="" action="/helpers/replies.php" method="post">
                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                        <input type="text" name="title" id="title" class="form-control input-sm" />
                        <input type="hidden" name="comment_id" id="comment_id" value="<?php echo $comment->id; ?>" />
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        <button type="submit" name="submit2" class="btn btn-primary btn-sm pull-right no-left-border">reply</button>
                    </div>
                  <div class="clearfix"></div>
                  <div class="margin-bottom"></div>
                  </form>
                  <div class="clearfix"></div>
                    <div class="replies" data-src="/helpers/LatestReplies.php" id="reply-<?php echo $comment->id; ?>">
                  <?php if(count($livecomment->getReplies($comment->id))>0):?>
                    <?php foreach($livecomment->getReplies($comment->id) as $reply): ?>
                      <div class="media reply-left" data-timestamps="<?php echo $reply->created_at; ?>" data-commentid="<?php echo $reply->comment_id; ?>">
                        <div class="media-left">
                        &nbsp;
                        </div>
                        <div class="media-body">
                          <?php echo $reply->title; ?>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                    </div>
                </div>
              </li>
            <?php endforeach; ?>             
            </ul>
            <!-- Stream Section ended -->
          </div>      
        </div>
      </div>
    </div>

    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/script.js"></script>
  </body>
</html>

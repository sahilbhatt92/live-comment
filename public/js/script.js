$(function(){
	$(document).on('click', '.make-reply', function(){
		var postReply = $(this).parent().find('#postReply');
		postReply.toggle(100);
		postReply.find('#title').focus();
	})	

$('#postComment').on('submit', function(e){
	e.preventDefault();
	var form = $(this);
	var html = "";
	if(form.find('#title').val() != "")
	{
		$.post(form.prop('action'), form.serialize(), function(data){
        	var obj = (JSON.parse(data));
        	form.find('#title').val('');

			html += '<li class="media comment-stream" data-timestamps="'+obj.created_at+'"><div class="media-left"></div><div class="media-body">';
			html += '<div>'+obj.title+'</div>';
			html += '<button type="button" class="btn btn-link btn-extended make-reply">Reply</button>';
			html += '<form id="postReply" class="" action="/helpers/replies.php" method="post">';
			html += '<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">';
			html += '<input type="text" name="title" id="title" class="form-control input-sm">';
			html += '<input type="hidden" name="comment_id" id="comment_id" value="'+obj.id+'">';
			html += '</div><div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">';
			html += '<button type="submit" name="submit2" class="btn btn-primary btn-sm pull-right no-left-border">reply</button>';
			html += '</div><div class="clearfix"></div><div class="margin-bottom"></div></form><div class="clearfix"></div><div class="replies" data-src="/helpers/LatestReplies.php" id="reply-'+obj.id+'"></div></div></li>';

			$('ul.media-list.comment-list').prepend(html);
    	});
    }
});

$( document ).on( "submit", "#postReply", function(e){
	e.preventDefault();
	var form = $(this);
	var html = "";
	if(form.find('#title').val() != "")
	{
		$.post(form.prop('action'), form.serialize(), function(data){
        	var obj = (JSON.parse(data));
        	form.find('#title').val('');

			html += '<div class="media reply-left" data-timestamps="'+obj.created_at+'" data-commentid="'+obj.comment_id+'">';
			html += '<div class="media-left">&nbsp;</div>';
			html += '<div class="media-body">'+obj.title+'</div></div>';

			form.parent().find('#reply-'+form.find('#comment_id').val()).prepend(html);
			$('#lt').val(obj.created_at);
			form.hide();
    	});
    }
});

var Stream = $('ul.media-list.comment-list');

setInterval(function(){

	$.post(Stream.data('src'), {'created_at':Stream.find('.media.comment-stream:first-child').data('timestamps')}, function(data){
		if(data != "")
			var obj = (JSON.parse(data));
		else
			var obj = null;		

		if(obj != null){
			var html = "";
			html += '<li class="media comment-stream" data-timestamps="'+obj.created_at+'"><div class="media-left"></div><div class="media-body">';
			html += '<div>'+obj.title+'</div>';
			html += '<button type="button" class="btn btn-link btn-extended make-reply">Reply</button>';
			html += '<form id="postReply" class="" action="/helpers/replies.php" method="post">';
			html += '<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">';
			html += '<input type="text" name="title" id="title" class="form-control input-sm">';
			html += '<input type="hidden" name="comment_id" id="comment_id" value="'+obj.id+'">';
			html += '</div><div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">';
			html += '<button type="submit" name="submit2" class="btn btn-primary btn-sm pull-right no-left-border">reply</button>';
			html += '</div><div class="clearfix"></div><div class="margin-bottom"></div></form><div class="clearfix"></div><div class="replies" id="reply-'+obj.id+'"></div></div></li>';

			Stream.prepend(html);
		}
	});

	$.post('/helpers/LatestReplies.php', {'created_at':$('#lt').val()}, function(data){
		if(data != "")
			var obj = (JSON.parse(data));
		else
			var obj = null;		

		if(obj != null){
			var html = "";
			html += '<div class="media reply-left" data-timestamps="'+obj.created_at+'" data-commentid="'+obj.comment_id+'">';
			html += '<div class="media-left">&nbsp;</div>';
			html += '<div class="media-body">'+obj.title+'</div></div>';

			$('#reply-'+obj.comment_id+'').prepend(html);
			$('#lt').val(obj.created_at);
		}
	});

}, 2000);

});
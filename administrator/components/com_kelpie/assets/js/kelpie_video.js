jQuery(document).ready(function($){
	
	var child = $("#jform_type_video").val();
	var url = $(".url").val();
	var url_hd = $(".url_hd").val();
	var thumb_video = $(".thumb_video").val();
	var preview_video = $(".preview_video").val();
	var path = $(".pathfile").val();
	
	
	
	
	$.ajax({method:"POST",url: "../administrator/components/com_kelpie/views/video/tmpl/ajax.php",data: {index:child, url:url, url_hd:url_hd,thumb_video:thumb_video, preview_video:preview_video, path:path}, success: function(result){
			$("#ajaxcontainer").html(result);	
	}});
	
	
	
	///$("#upload_list > div").hide();
	++child;
	$("#upload_list  div:nth-child("+child+")").show();
	
	
	$("#jform_type_video").change(function(){
		//$("#upload_list > div").hide();
		var child2 = $("#jform_type_video").val();
		//++child2;
		//s$("#upload_list  div:nth-child("+child2+")").show();
		$.ajax({method:"POST",url: "../administrator/components/com_kelpie/views/video/tmpl/ajax.php",data: {index:child2, url:url, url_hd:url_hd, thumb_video:thumb_video, preview_video:preview_video, path:path}, success: function(result){
			$("#ajaxcontainer").html(result);	
		}});
		
	});
	
	
	$(".button_upload1").click(function(events){
		events.preventDefault();
		
		
	});
	
	
	
});

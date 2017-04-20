<?php /**
 * @package     Joomla.Administrator
 * @subpackage  com_kelpie
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
 ?>

 

<?php 
	$index = $_POST['index'];
	$url = $_POST['url'];
	$url_hd = $_POST['url_hd'];
	$thumb_video = $_POST['thumb_video'];
	$preview_video = $_POST['preview_video'];
	$path = urlencode($_POST['path']);
?>

<?php if($index == 0):?>
<div>
	<label id="jform_url_video-lbl" for="jform_url_video" class="hasPopover" title="" data-content="Description" data-original-title="Video">Video</label>
	<input name="jform[url_video]"  value="<?php echo $url;?>" id="jform_url_video"  class="inputbox" type="text">
</div>
<div>
	<label id="jform_url_hd_video-lbl" for="jform_url_hd_video" class="hasPopover" title="" data-content="Description" data-original-title="Video HD">Video HD</label>
	<input name="jform[url_hd_video]"  value="<?php echo $url_hd;?>" id="jform_url_hd_video"  class="inputbox" type="text">
<div>
</div>
	<label id="jform_thumb_video-lbl" for="jform_thumb_video" class="hasPopover" title="" data-content="Description" data-original-title="Thumb Video">Thumb Video</label>
	<input name="jform[thumb_video]"  value="<?php echo $thumb_video;?>" id="jform_thumb_video"  class="inputbox" type="text">
<div>
<div>
	<label id="jform_preview_video-lbl" for="jform_preview_video" class="hasPopover" title="" data-content="Description" data-original-title="Preview Video">Preview Video</label>
	<input name="jform[preview_video]"  value="<?php echo $preview_video;?>" id="jform_preview_video"  class="inputbox" type="text">
</div>

<?php endif;?>


<?php if($index == 1):?>
<div>
	<label id="jform_url_video-lbl" for="jform_url_video" class="hasPopover" title="" data-content="Description" data-original-title="Video">Video</label>
	<input name="jform[url_video]"  value="<?php echo $url;?>" id="jform_url_video"  class="inputbox inputbox1" type="text"><input type="file" accept=".mp4" class="classfile input1"/><button class="button_upload1">Browser</button>
</div>
<div>
	<label id="jform_url_hd_video-lbl" for="jform_url_hd_video" class="hasPopover" title="" data-content="Description" data-original-title="Video HD">Video HD</label>
	<input name="jform[url_hd_video]"  value="<?php echo $url_hd;?>" id="jform_url_hd_video"   class="inputbox inputbox2" type="text"><button class="button_upload2">Browser</button>
</div>
<div>
	<label id="jform_thumb_video-lbl" for="jform_thumb_video" class="hasPopover" title="" data-content="Description" data-original-title="Thumb Video">Thumb Video</label>
	<input name="jform[thumb_video]"  value="<?php echo $thumb_video;?>" id="jform_thumb_video"   class="inputbox inputbox3" type="text"><button class="button_upload3">Browser</button>
</div>
<div>
	<label id="jform_preview_video-lbl" for="jform_preview_video" class="hasPopover" title="" data-content="Description" data-original-title="Preview Video">Preview Video</label>
	<input name="jform[preview_video]"  value="<?php echo $preview_video;?>" id="jform_preview_video"   class="inputbox inputbox4" type="text"><button class="button_upload4">Browser</button>
</div>

<?php endif;?>


<?php if($index == 2):?>
<div>
	<label id="jform_url_video-lbl" for="jform_url_video" class="hasPopover" title="" data-content="Description" data-original-title="Video">Video</label>
	<input name="jform[url_video]"  value="<?php echo $url;?>" id="jform_url_video"  class="inputbox" type="text">
</div>
</div>
	<label id="jform_thumb_video-lbl" for="jform_thumb_video" class="hasPopover" title="" data-content="Description" data-original-title="Thumb Video">Thumb Video</label>
	<input name="jform[thumb_video]"  value="<?php echo $thumb_video;?>" id="jform_thumb_video"  class="inputbox" type="text">
<div>
<div>
	<label id="jform_preview_video-lbl" for="jform_preview_video" class="hasPopover" title="" data-content="Description" data-original-title="Preview Video">Preview Video</label>
	<input name="jform[preview_video]"  value="<?php echo $preview_video;?>" id="jform_preview_video"  class="inputbox" type="text">
</div>
<?php endif;?>

<script>

	jQuery(function($){
		$(".upload_browser").css("display", "none");
		var form;
		className = "";
		var path = "<?php echo $path;?>";
		
		$(".classfile").css("display","none");
		
		$(".button_browser").click(function(event){
			event.preventDefault(); 
			$(".upload_browser").click();
		});
		
	
	
		$(".button_upload1").click(function(event){
			event.preventDefault(); 
			var father = $(this).parent('div');
			var getClass = father.find('input').attr("class").split(' ');
			className = getClass[1];
			$(".kelpie_modal").css("display","block");
			$(".msn_upload1").val(" ");
			$(".upload_browser").attr("accept",".mp4, .mv4, .flv");
		});
		
		
		$(".button_upload2").click(function(event){
			event.preventDefault(); 
			var father = $(this).parent('div');
			var getClass = father.find('input').attr("class").split(' ');
			className = getClass[1];
			$(".kelpie_modal").css("display","block");
			$(".msn_upload1").val(" ");
			$(".upload_browser").attr("accept",".mp4, .mv4, .flv");
		});
		
		
		$(".button_upload3").click(function(event){
			event.preventDefault(); 
			father3 = $(this).parent('div');
			getClass3 = father3.find('input').attr("class").split(' ');
			className = getClass3[1];
			$(".kelpie_modal").css("display","block");
			$(".msn_upload1").val(" ");
			$(".upload_browser").attr("accept","image/*");
			
		});
		
		
		
		$(".button_upload4").click(function(event){
			event.preventDefault(); 
			father3 = $(this).parent('div');
			getClass3 = father3.find('input').attr("class").split(' ');
			className = getClass3[1];
			$(".kelpie_modal").css("display","block");
			$(".msn_upload1").val(" ");
			$(".upload_browser").attr("accept",".mp4, .mv4, .flv");

		});
		
		
		$(".close").click(function(event){
			$(".kelpie_modal").css("display","none");
		});
		
		$(".kelpie_modal").click(function(event){
			//$(".kelpie_modal").css("display","none");
		});
		
		
		$(".button_send").click(function(events){
			events.preventDefault();
			//alert(className);
			$("."+className).val($(".msn_upload1").val());
			$(".kelpie_modal").css("display","none");
		
		});
		
		
		$(".upload_browser").change(function(event){
			var value = $(".upload_browser").val();
			//$(".inputbox1").val(value);
			
			form = new FormData();
			form.append('fileUpload', event.target.files[0]);
			form.append('path', path);
			
			$(".kelpie_modal_loading").css("display","block");
			
			$.ajax({
				url: '../administrator/components/com_kelpie/views/video/tmpl/upload.php', // Url do lado server que vai receber o arquivo
				data: form,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (data) {
					//alert(data);
					$(".msn_upload1").val(data);
					$(".kelpie_modal_loading").css("display","none");
					
					if(data =="Error Upload" ){
						
						$(".msn_error").css("display","block");
					}else{
						$(".msn_sucess").css("display","block");
						$(".button_send").css("display","block");
					}	
				}
			});
			
			
			
		});
		
		
	});

</script>


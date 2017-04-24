<?php 
// No direct access
defined('_JEXEC') or die; 

$doc = JFactory::getDocument();
//$doc->addScript( JURI::root()."administrator/components/com_kelpie/assets/js/flashobject.js" );
$doc->addStyleSheet( JURI::root()."administrator/components/com_kelpie/assets/css/kelpie_player.css" );


$videoid = $params->get('videoid');

?>
<?php //echo $hello; ?>
<?php print_r($params->get('videoid'));?>
<?php print_r($videos);?>


<?php foreach($player as $players):?>

		<?php 
		
			if($players->width == 0 && $players->height == 0){
				
				
				if($players->type == "flash"){
					
					$width = "400";
					$height = "400";
				}
				
				
			}else{
				$width = $players->width;
				$height =  $players->height;
			}
		?>
		<?php  foreach($list as $lists): ?>
		
	
		<h1><?php echo $lists->title_video;?></h1>
			
		
		<?php if($players->type == "flash"):?>
			
			<?php if($lists->type_video != 2):?>
				<?php $url = urlencode($lists->url_video);?>
				
				<script type="text/javascript" src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/js/flashobject.js";?>"></script>
				<div id="player_7788" style="display:inline-block;">
					<a href="http://get.adobe.com/flashplayer/">You need to install the Flash plugin</a> - <a href="http://www.webestools.com/">http://www.webestools.com/</a>
				</div>
				<script type="text/javascript">
				
					var url = "<?php echo $url;?>";
					var width = "<?php echo $width;?>";
					var height = "<?php echo $height;?>";
					var thumb = "<?php echo $lists->thumb_video;?>";
				
					var flashvars_7788 = {};
					var params_7788 = {
						quality: "high",
						wmode: "transparent",
						bgcolor: "#000000",
						allowScriptAccess: "always",
						allowFullScreen: "true",
						flashvars: "fichier="+url+"&auto_play=false&apercu="+thumb
					};
					var attributes_7788 = {};
					flashObject("<?php echo JURI::root()."administrator/components/com_kelpie/assets/player/v1_2.swf";?>", "player_7788", width, height, "8", false, flashvars_7788, params_7788, attributes_7788);
				</script>
			<?php else:?>
					<?php  
			  $url_explode = explode("v=",$lists->url_video);
			  $url_id = $url_explode[1];
								
		?>
			
			
						<object width="<?php echo $width;?>" height="<?php echo $height;?>">
						  <param name="movie" value="https://www.youtube.com/embed/<?php echo $url_id;?>"></param>
						  <param name="allowScriptAccess" value="always"></param>
						  <param name="scrolling" value="no"></param>
						  <embed src="https://www.youtube.com/embed/<?php echo $url_id;?>" allowscriptaccess="always" width="422" height="258"></embed>
						</object>
						
						
									
			<?php endif;?>
			
		<?php else:?>

				<?php if($lists->type_video != 2):?>
					<video width="<?php echo $width ;?>" height="<?php echo $height ;?>" poster="<?php echo $lists->thumb_video;?>" controls>
					  <source src="<?php echo $lists->url_video;?>" type="video/mp4">
					  <source src="movie.ogg" type="video/ogg">
					Your browser does not support the video tag.
					</video>
					
				<?php else:?>
				<?php  
			  $url_explode = explode("v=",$lists->url_video);
			  $url_id = $url_explode[1];
								
		?>
				<div class="videoWrapper">
						<iframe width="<?php echo $width ;?>" height="<?php echo $height ;?>" src="https://www.youtube.com/embed/<?php echo $url_id;?>" frameborder="0" allowfullscreen></iframe>
				</div>

				<?php endif;?>
			
		<?php endif;?>
		
		<?php endforeach;?>
<?php endforeach;?>
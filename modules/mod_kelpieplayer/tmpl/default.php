<?php 
// No direct access
defined('_JEXEC') or die; 

$doc = JFactory::getDocument();
//$doc->addScript( JURI::root()."administrator/components/com_kelpie/assets/js/flashobject.js" );


?>
<?php //echo $hello; ?>



<?php //print_r($player);?>



<?php foreach($player as $players):?>

		<?php 
		
			if($players->width == 0 && $players->height == 0){
				$width = "100%";
				$height = "auto";
			}else{
				$width = $players->width;
				$height =  $players->height;
			}
		?>
		<?php  foreach($list as $lists): ?>
		<?php if($players->type == "flash"):?>
			<h1><?php echo $lists->title_video;?></h1>
			
			<?php $url = urlencode($lists->url_video);?>
			
			<script type="text/javascript" src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/js/flashobject.js";?>"></script>
			<div id="player_7788" style="display:inline-block;">
				<a href="http://get.adobe.com/flashplayer/">You need to install the Flash plugin</a> - <a href="http://www.webestools.com/">http://www.webestools.com/</a>
			</div>
			<script type="text/javascript">
			
				var url = "<?php echo $url;?>";
				var width = "<?php echo $width;?>";
				var height = "<?php echo $height;?>";
			
				var flashvars_7788 = {};
				var params_7788 = {
					quality: "high",
					wmode: "transparent",
					bgcolor: "#000000",
					allowScriptAccess: "always",
					allowFullScreen: "true",
					flashvars: "fichier="+url+"&auto_play=false&apercu=http%3A%2F%2Fflash.webestools.com%2Fflv_player%2Fextract_elephant_dream.png"
				};
				var attributes_7788 = {};
				flashObject("<?php echo JURI::root()."administrator/components/com_kelpie/assets/player/v1_2.swf";?>", "player_7788", width, height, "8", false, flashvars_7788, params_7788, attributes_7788);
			</script>
			
			
		<?php else:?>
			
					<h1><?php echo $lists->title_video;?></h1>
					
	
					<video width="<?php echo $width ;?>" height="<?php echo $height ;?>" poster="<?php echo $lists->thumb_video;?>" controls>
					  <source src="<?php echo $lists->url_video;?>" type="video/mp4">
					  <source src="movie.ogg" type="video/ogg">
					Your browser does not support the video tag.
					</video>
	
			
			
		<?php endif;?>
		
		<?php endforeach;?>
<?php endforeach;?>
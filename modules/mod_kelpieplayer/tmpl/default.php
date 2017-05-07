<?php 
// No direct access
defined('_JEXEC') or die; 

JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');


$doc = JFactory::getDocument();



$doc->addStyleSheet( JURI::root()."modules/mod_kelpieplayer/assets/css//jquery-ui.css" );


$doc->addStyleSheet( JURI::root()."administrator/components/com_kelpie/assets/css/kelpie_player.css" );

$doc->addStyleSheet( JURI::root()."modules/mod_kelpieplayer/assets/css/play_style.css" );

echo "<script src='".JURI::root()."modules/mod_kelpieplayer/assets/js/jquery-3.2.1.min.js'></script>";
echo "<script src='".JURI::root()."modules/mod_kelpieplayer/assets/js/jquery-ui.js'></script>";
echo "<script src='".JURI::root()."modules/mod_kelpieplayer/assets/js/playerjs.js'></script>";



$videoid = $params->get('videoid');

?>
<?php //echo $hello; ?>
<?php //print_r($params->get('videoid'));?>
<?php //print_r($videos);

$url = "";
$player_type = "youtube";
$autoplay = true;
$volume = 100;
$ratio = 1;

if($videos[0]->type_video == 0 || $videos[0]->type_video == 1){
	
	$url = $videos[0]->url_video;
	$player_type = "html5";
	
}else if($videos[0]->type_video == 2){
	
	$link = explode("=", $videos[0]->url_video);
	
	$url = $link[1];
	$player_type = "youtube";
	
}

if($params->get('autoplay') == 1){
	$autoplay =  true;
}else if($params->get('autoplay') == 0){
	$autoplay =  false;
}

if($params->get('volume') == 0){
	$volume = 0;

}else if($params->get('volume') > 0){
	$volume = $params->get('volume');
}

if($params->get('ratio') == ""){
	$ratio = 1;

}else if($params->get('ratio') == 0){
	$ratio = 0;

}else if($params->get('ratio') > 0){
	$ratio = $params->get('ratio');
}

?>	
	<?php if($params->get('show_title') == 1):?>
		<h2><?php echo $videos[0]->title_video;?></h2>
	<?php endif;?>
	
	
	<div id="player" class="player"></div>


<?php

 echo "<script>
	   jQuery(function($) {
		   $('#player').kelpie('".$player_type."',{
				color:'dd',
				url:'".$url."',
				autoplay: '".$autoplay."',
				volume: '".$volume."',
				ratio: '".$ratio."'
			});
	   })
	
</script>";?>


<?php if($params->get('show_description') == 1):?>
	<p class="desc_video"><?php echo $videos[0]->text_video;?></p>
<?php endif;?>


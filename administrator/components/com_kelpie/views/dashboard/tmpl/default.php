<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');


$doc = JFactory::getDocument();

//$doc->addStyleSheet( "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", "text/css", "screen" );
$doc->addStyleSheet( JURI::root()."administrator/components/com_kelpie/assets/css/kelpie.css", "text/css", "screen" );


//$doc->addScript("https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" );
//$doc->addScript("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" );
$doc->addScript( JURI::root()."administrator/components/com_kelpie/assets/js/kelpie.js" );


//JHTML::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');

?>


<div class="kelpie_painel">

	<div class="kelpie_sidebar">
		<ul class="nav nav-list">
			<li class="active"><a href="index.php?option=com_kelpie">DashBoard</a></li>
			<li ><a href="index.php?option=com_kelpie&view=categories">Categories</a></li>
			<li><a href="index.php?option=com_kelpie&view=videos">Videos</a></li>
			<li ><a href="index.php?option=com_kelpie&view=players">Players</a></li>

		</ul>
	</div>
	<div class="kelpie_content">
		<div class="kelpie_content_icon">
			<div class="kelpie_content_icon_fig">
				<a href="index.php?option=com_kelpie&view=video&layout=edit">
					<img src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/addmovie.png";?>">
				<span>Add Video</span>
				</a>
			</div>
			<div class="kelpie_content_icon_fig">
				<a href="index.php?option=com_kelpie&view=category&layout=edit">
					<img src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/addcategory.png";?>">
				<span>Add Category</span>
				</a>
			</div>
			<div class="kelpie_content_icon_fig">
				<img src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/config.png";?>">
				<span>Add Config</span>
			</div>
			<div class="kelpie_content_icon_fig">
				<a href="index.php?option=com_kelpie&view=players">
				<img src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/player.png";?>">
				<span>Player</span>
				</a>
			</div>
			<div class="kelpie_content_icon_fig">
				<img src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/unlock.png";?>">
				<span>Licensing</span>
			</div><div class="kelpie_content_icon_fig">
				<img src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/advise.png";?>">
				<span>Add Advert</span>
			</div>
			<div class="kelpie_content_icon_fig">
				<img src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/aprove.png";?>">
				<span>Approval</span>
			</div>
		</div>
		<div class="kelpie_content_status">
		
		
		
		
		<div class="container">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Server Information</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
		<table class="kelpie_content_status_table">
				<tr>
					<td class="td_img"><img alt="allow_fileuploads" src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/1492247677_cloud-download.png";?>"></td>
					<td class="td_text">allow_fileuploads</td>
					<td class="td_res"><?php  echo $this->serverDetails[0]['value'];?></td>
				</tr>
				<tr>
					<td class="td_img"><img alt="upload_max_filesize" src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/1492248400_save.png";?>"></td>
					<td class="td_text">upload_max_filesize</td>
					<td class="td_res"><?php  echo $this->serverDetails[1]['value'];?></td>
				</tr>
				<tr>
					<td class="td_img"><img alt="max_input_time" src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/1492250259_history.png";?>"></td>
					<td class="td_text">max_input_time</td>
					<td class="td_res"><?php  echo $this->serverDetails[2]['value'];?></td>
				</tr>
				<tr>
					<td class="td_img"><img alt="memory_limit" src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/1492250391_folder-mydrive.png";?>"></td>
					<td class="td_text">memory_limit</td>
					<td class="td_res"><?php  echo $this->serverDetails[3]['value'];?></td>
				</tr>
				<tr>
					<td class="td_img"><img alt="max_execution_time" src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/1492250458_swap-vert.png";?>"></td>
					<td class="td_text">max_execution_time</td>
					<td class="td_res"><?php  echo $this->serverDetails[4]['value'];?></td>
				</tr>
				<tr>
					<td class="td_img"><img alt="post_max_size" src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/1492250522_drive-script.png";?>"></td>
					<td class="td_text">post_max_size</td>
					<td class="td_res"><?php  echo $this->serverDetails[5]['value'];?></td>
				</tr>
				<tr>
					<td class="td_img"><img alt="upload_directory_permission" src="<?php echo JURI::root()."administrator/components/com_kelpie/assets/images/1492250579_done-all.png";?>"></td>
					<td class="td_text">upload_directory_permission</td>
					<td class="td_res">Yes</td>
				</tr>
			</table>
		</div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Recently Added Videos</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
			<table>
				<?php foreach(KelpieModelDashBoard::getLastestVideos() as $video):?>
				<tr>
					<td><a href="index.php?option=com_kelpie&view=video&layout=edit&id=<?php echo $video->id;?>"><?php echo $video->title_video;?></a></td>
				</tr>
				<?php endforeach;?>
			</table>
		
		</div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Most Viewed Videos</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
      </div>
    </div>
  </div> 
</div>
		
		</div>
	</div>
	
	
	
	
</div>

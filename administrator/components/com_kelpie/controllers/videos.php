<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_semanafluminense
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * HelloWorld Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 * @since       0.0.9
 */
class KelpieControllerVideos extends JControllerAdmin
{	


	public function publish(){
		$task = $this->getTask();
		
		$cid = $_POST['cid'];
		
		if($task == "publish"){
			foreach($cid as $id){
			
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->UPDATE('#__kp_video')->SET('published = 1')->where('#__kp_video.id'. '  = '.$id);
				$db->setQuery($query);
				$db->loadObjectList();
				
				$message = JText::plural('COM_KELPIE_VIDEOS_PUBLISHED_SUCESS');
			}
			
		}else if($task == "unpublish"){
			
			foreach($cid as $id){
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->UPDATE('#__kp_video')->SET('published = 0')->where('#__kp_video.id'. '  = '.$id);
				$db->setQuery($query);
				$db->loadObjectList();
			
			}
			
			$message = JText::plural('COM_KELPIE_VIDEOS_UNPUBLISHED_SUCESS');
			
			
		}
		
		
		$this->setRedirect(JRoute::_('index.php?option=com_kelpie&view=videos', false), $message);
		
		//echo"<script>window.history.go(-1);</script>";
                

	}

	
	public function getModel($name = 'Videos', $prefix = 'KelpieModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
 
		return $model;
	}
}
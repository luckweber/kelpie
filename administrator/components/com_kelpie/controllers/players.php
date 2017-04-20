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
class KelpieControllerPlayers extends JControllerAdmin
{	


	public function publish(){
		$task = $this->getTask();
		
		$cid = $_POST['cid'];
		
		if($task == "publish"){
			foreach($cid as $id){
			
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->UPDATE('#__kp_player')->SET('published = 1')->where('#__kp_player.id'. '  = '.$id);
				$db->setQuery($query);
				$db->loadObjectList();
				
				$message = JText::plural('COM_KELPIE_PLAYERS_PUBLISHED_SUCESS');
			}
			
		}else if($task == "unpublish"){
			
			foreach($cid as $id){
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->UPDATE('#__kp_player')->SET('published = 0')->where('#__kp_player.id'. '  = '.$id);
				$db->setQuery($query);
				$db->loadObjectList();
			
			}
			
			$message = JText::plural('COM_KELPIE_PLAYERS_UNPUBLISHED_SUCESS');
			
			
		}
		
		
		$this->setRedirect(JRoute::_('index.php?option=com_kelpie&view=players', false), $message);
		
		//echo"<script>window.history.go(-1);</script>";
                

	}

	
	public function getModel($name = 'Categories', $prefix = 'KelpieModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
 
		return $model;
	}
}
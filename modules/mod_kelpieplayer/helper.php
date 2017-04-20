<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModKelpiePlayerHelper 
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getHello($params)
    {
        return 'Hello, World!';
    }
	
	 public static function getPlayer($params){
		 $db = JFactory::getDbo();
		 $query = $db->getQuery(true);
		 $query->select(array('a.*'))->from($db->quoteName('#__kp_player', 'a'));
		 $db->setQuery($query);
		 $results = $db->loadObjectList();
		
         return $results;

	 }
	
	 public static function getList($params)
    {
		$module = &JModuleHelper::getModule('mod_kelpieplayer'); 
		$params = json_decode($module->params);
		// Get a db connection.
		$db = JFactory::getDbo();
		
		// Create a new query object.
		$query = $db->getQuery(true);
		
		//Type ID, CATEGORY, LIST
		if($params->listop == 0){
			$query->select(array('a.*'))->from($db->quoteName('#__kp_video', 'a'))->where($db->quoteName('a.id') . ' ='.$params->inputid)->order($db->quoteName('a.created') . ' DESC');

		}else{
			$query->select(array('a.*'))->from($db->quoteName('#__kp_video', 'a'));

			
		}
		$db->setQuery($query);
		$results = $db->loadObjectList();
		
        return $results;
    }
}
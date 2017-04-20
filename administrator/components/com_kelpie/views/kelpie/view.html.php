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
 
/**
 * HTML View class for the HelloWorld Component
 *
 * @since  0.0.1
 */
 
jimport('joomla.application.component.view');
 
 
class KelpieViewKelpie extends JViewLegacy
{
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		$this->msg = 'Hello World';
		
		
 
		// Display the view
		parent::display($tpl);
		$this->addToolbar();
		
		

	}
	
	
	 protected function addToolbar(){
        require_once JPATH_COMPONENT . '/helpers/kelpie.php';
        JToolBarHelper::title( 'Hello World', 'kelpie' );
        JToolBarHelper::addNew();
        JToolBarHelper::deleteList();
        JToolBarHelper::editList();
		JToolBarHelper::preferences('com_kelpie', '500');
		$this->sidebar = JHtmlSidebar::render();
    }
}
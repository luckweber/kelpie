<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_kelpie
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
 
 
 
class kelpieViewPlayer extends JViewLegacy
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
		
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		
		
		// Display the view
		parent::display($tpl);
		$this->addToolbar();
		
		

	}
	
	
	 protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;
 
		// Hide Joomla Administrator Main menu
		$input->set('hidemainmenu', true);
 
		$isNew = ($this->item->id == 0);
 
		if ($isNew)
		{
			$title = JText::_('COM_KELPIE_MANAGER_PLAYER_ADD');
		}
		else
		{
			$title = JText::_('COM_KELPIE_MANAGER_PLAYER_EDIT');
		}
 
		JToolBarHelper::title($title, 'player');
		JToolBarHelper::apply('player.apply', 'JTOOLBAR_APPLY');
		JToolBarHelper::save('player.save');
		
		JToolBarHelper::cancel(
			'player.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
	}
	
}
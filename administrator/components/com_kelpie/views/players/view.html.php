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
 * HelloWorlds View
 *
 * @since  0.0.1
 */
class KelpieViewPlayers extends JViewLegacy
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
		// Set the submenu
		
		JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
		
		
		//KelpieHelper::addSubmenu('kelpie');
		
		// Get application
		$app = JFactory::getApplication();
		$context = "kelpie.list.admin.kelpie";
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state			= $this->get('State');
		$this->filter_order 	= $app->getUserStateFromRequest($context.'filter_order', 'filter_order', 'title_video', 'cmd');
		$this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
		
		
		// Set the toolbar
		$this->addToolBar();
 
		// Display the template
		parent::display($tpl);
		
		// Set the document
		$this->setDocument();
	}
	
	
	
	protected function addToolBar(){
		
		
		//$canDo = JHelperContent::getActions('com_kelpie', 'category', $this->state->get('filter.category_id'));
		$user  = JFactory::getUser();
		$bar = JToolbar::getInstance('toolbar');
		
		

		if ($user->authorise('core.admin', 'com_kelpie') || $user->authorise('core.options', 'com_kelpie'))
		{
			JToolBarHelper::addNew('player.add');
		}
		
		JToolBarHelper::title(JText::_('COM_KELPIE_CATEGORIES_TITLE_LIST'));
		//JToolBarHelper::addNew('poesia.add');
		JToolBarHelper::editList('player.edit');
		JToolBarHelper::deleteList('', 'players.delete');
		JToolbarHelper::publish('players.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::help('JHELP_CONTENT_ARTICLE_MANAGER');


	}
	
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		//$document->setTitle(JText::_('COM_KELPIE_VIDEOS_TITLE_LIST'));
	}
}
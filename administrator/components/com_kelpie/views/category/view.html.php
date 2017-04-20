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
 
 
class KelpieViewCategory extends JViewLegacy
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
		
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->state = $this->get('State');
		
		$numbers = array();
		$numbers = [1,2];
		
		$this->lists = KelpieModelCategory::getCategories();
		//$this->full  = KelpieModelCategory::ListCategories('parent');
		$this->full  = KelpieModelCategory::ListCategories( 'jform[parent]', $this->item->parent, '', $this->item->name );
		$this->n  = KelpieModelCategory::getCategoryTree($numbers);
 
		// Display the view
		
		$this->form->setFieldAttribute('extension', 'default', 'com_kelpie');
		
		
		parent::display($tpl);
		$this->addToolbar();
		
		

	}
	
	
	 protected function addToolbar(){
			JToolbarHelper::apply('category.apply');
			JToolbarHelper::save('category.save');
			JToolbarHelper::save2new('category.save2new');
			JToolbarHelper::cancel('category.cancel');
    }
}
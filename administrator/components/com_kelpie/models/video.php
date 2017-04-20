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
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class KelpieModelVideo extends JModelAdmin
{
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'video', $prefix = 'KelpieTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
 
	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed    A JForm object on success, false on failure
	 *
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm(
			'com_kelpie.video',
			'video',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);
 
		if (empty($form))
		{
			return false;
		}
 
		return $form;
	}
	
	
	public static function getCategories( $exclude_category = '' ) {
	
        $db = JFactory::getDBO();
		
		$query = 'SELECT * FROM #__kp_category';
		
		if( ! empty( $exclude_category ) ) {
			$query .= ' WHERE name!=' . $db->quote( $exclude_category );
		}
		
		$query .= ' ORDER BY ordering ASC';
		$db->setQuery( $query );
		$mitems = $db->loadObjectList();
		
		$children = array();
		if( $mitems ) {
			foreach( $mitems as $v ) {
				$v->title = $v->name;
				$v->parent_id = $v->parent;
				$pt = $v->parent;				
				$list = @$children[ $pt ] ? $children[ $pt ] : array();
				array_push( $list, $v );
				$children[ $pt ] = $list;
			}
		}
		
		$list = JHTML::_( 'menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );	
			
		return $list;
		
	}
	
	public static function ListCategories( $name = 'category', $selected = '', $script = '', $exclude_category = '' ) {

		if( 'parent' == $name ) {		
			$options[] = JHTML::_( 'select.option', 0, '-- '.JText::_( 'ROOT' ).' --' );
			if( '' == $selected ) $selected = 0;
		} else {
			$options[] = JHTML::_( 'select.option', '', '-- '.JText::_( 'SELECT_A_CATEGORY' ).' --' );
		}
		
		if( ! empty( $exclude_category ) ) {
			$items = KelpieModelVideo::getCategories( $exclude_category );
		} else {
			$items = KelpieModelVideo::getCategories();
		}
		
		foreach( $items as $item ) {
			$item->treename = JString::str_ireplace( '&#160;', '-', $item->treename );
			$value = ( 'category' == $name || 'filter_category' == $name ) ? $item->name : $item->id;
			
			$options[] = JHTML::_( 'select.option', $value, $item->treename );
		}
		
		return JHTML::_( 'select.genericlist', $options, $name, $script, 'value', 'text', $selected,'jform_catid' );

	}
 
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState(
			'com_kelpie.edit.video.data',
			array()
		);
 
		if (empty($data))
		{
			$data = $this->getItem();
		}
 
		return $data;
	}
	/**
	 * Method to get the script that have to be included on the form
	 *
	 * @return string	Script files
	 */
	public function getScript() 
	{
		return 'administrator/components/com_semanafluminense/models/forms/semanafluminense.js';
	}
	
	protected function prepareTable($table)
	{
		// Set the publish date to now
		$db = $this->getDbo();

		if ($table->state == 1 && (int) $table->publish_up == 0)
		{
			$table->publish_up = JFactory::getDate()->toSql();
		}

		if ($table->state == 1 && intval($table->publish_down) == 0)
		{
			$table->publish_down = $db->getNullDate();
		}

		// Increment the content version number.
		$table->version++;

		// Reorder the articles within the category so the new article is first
		if (empty($table->id))
		{
			//$table->reorder('catid = ' . (int) $table->catid . ' AND state >= 0');
		}
	}
	
	
	private function canCreateCategory()
	{
		return JFactory::getUser()->authorise('core.create', 'com_kelpie');
	}
}
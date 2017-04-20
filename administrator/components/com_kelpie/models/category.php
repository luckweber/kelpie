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
class KelpieModelCategory extends JModelAdmin
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
	public function getTable($type = 'Category', $prefix = 'KelpieTable', $config = array())
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
			'com_kelpie.category',
			'category',
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
			$items = KelpieModelCategory::getCategories( $exclude_category );
		} else {
			$items = KelpieModelCategory::getCategories();
		}
		
		foreach( $items as $item ) {
			$item->treename = JString::str_ireplace( '&#160;', '-', $item->treename );
			$value = ( 'category' == $name || 'filter_category' == $name ) ? $item->name : $item->id;
			
			$options[] = JHTML::_( 'select.option', $value, $item->treename );
		}
		
		return JHTML::_( 'select.genericlist', $options, $name, $script, 'value', 'text', $selected );

	}
	
	
	public static function getCategoryTree( $ids ) {
	
		$db = JFactory::getDBO();	
				
		$ids = (array) $ids;
		JArrayHelper::toInteger( $ids );
		$catid  = array_unique( $ids );
		sort( $ids );
		
		$array = $ids;				
		while( count( $array ) ) {
			$query = "SELECT id FROM #__kp_category WHERE parent IN (" . implode( ',', $array ) . ") AND id NOT IN (" . implode( ',', $array ) . ")";
			$db->setQuery( $query );
			$array = $db->loadColumn();
			$ids = array_merge( $ids, $array );
		}
		JArrayHelper::toInteger( $ids );
		$ids = array_unique( $ids );			
			
		return $ids;
		
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
			'com_kelpie.edit.category.data',
			array()
		);
 
		if (empty($data))
		{
			$data = $this->getItem();
		}
 
		return $data;
	}
	
	
	public function getAssoc()
	{
		static $assoc = null;

		if (!is_null($assoc))
		{
			return $assoc;
		}

		$extension = $this->getState('category.extension');

		$assoc = JLanguageAssociations::isEnabled();
		$extension = explode('.', $extension);
		$component = array_shift($extension);
		$cname = str_replace('com_', '', $component);

		if (!$assoc || !$component || !$cname)
		{
			$assoc = false;
		}
		else
		{
			$hname = $cname . 'HelperAssociation';
			JLoader::register($hname, JPATH_SITE . '/components/' . $component . '/helpers/association.php');

			$assoc = class_exists($hname) && !empty($hname::$category_association);
		}

		return $assoc;
	}
	
	
	protected function preprocessForm(JForm $form, $data, $group = 'content')
	{
		jimport('joomla.filesystem.path');

		$lang = JFactory::getLanguage();
		$component = $this->getState('category.component');
		$section = $this->getState('category.section');
		$extension = JFactory::getApplication()->input->get('extension', null);

		// Get the component form if it exists
		$name = 'category' . ($section ? ('.' . $section) : '');

		// Looking first in the component models/forms folder
		$path = JPath::clean(JPATH_ADMINISTRATOR . "/components/$component/models/forms/$name.xml");

		// Old way: looking in the component folder
		if (!file_exists($path))
		{
			$path = JPath::clean(JPATH_ADMINISTRATOR . "/components/$component/$name.xml");
		}

		if (file_exists($path))
		{
			$lang->load($component, JPATH_BASE, null, false, true);
			$lang->load($component, JPATH_BASE . '/components/' . $component, null, false, true);

			if (!$form->loadFile($path, false))
			{
				throw new Exception(JText::_('JERROR_LOADFILE_FAILED'));
			}
		}

		// Try to find the component helper.
		$eName = str_replace('com_', '', $component);
		$path = JPath::clean(JPATH_ADMINISTRATOR . "/components/$component/helpers/category.php");

		if (file_exists($path))
		{
			require_once $path;
			$cName = ucfirst($eName) . ucfirst($section) . 'HelperCategory';

			if (class_exists($cName) && is_callable(array($cName, 'onPrepareForm')))
			{
				$lang->load($component, JPATH_BASE, null, false, false)
					|| $lang->load($component, JPATH_BASE . '/components/' . $component, null, false, false)
					|| $lang->load($component, JPATH_BASE, $lang->getDefault(), false, false)
					|| $lang->load($component, JPATH_BASE . '/components/' . $component, $lang->getDefault(), false, false);
				call_user_func_array(array($cName, 'onPrepareForm'), array(&$form));

				// Check for an error.
				if ($form instanceof Exception)
				{
					$this->setError($form->getMessage());

					return false;
				}
			}
		}

		// Set the access control rules field component value.
		$form->setFieldAttribute('rules', 'component', $component);
		$form->setFieldAttribute('rules', 'section', $name);
				

		// Association category items
		$assoc = $this->getAssoc();

		if ($assoc)
		{
			$languages = JLanguageHelper::getLanguages('lang_code');
			$addform = new SimpleXMLElement('<form />');
			$fields = $addform->addChild('fields');
			$fields->addAttribute('name', 'associations');
			$fieldset = $fields->addChild('fieldset');
			$fieldset->addAttribute('name', 'item_associations');
			$fieldset->addAttribute('description', 'COM_CATEGORIES_ITEM_ASSOCIATIONS_FIELDSET_DESC');
			$add = false;

			foreach ($languages as $tag => $language)
			{
				if (empty($data->language) || $tag != $data->language)
				{
					$add = true;
					$field = $fieldset->addChild('field');
					$field->addAttribute('name', $tag);
					$field->addAttribute('type', 'modal_category');
					$field->addAttribute('language', $tag);
					$field->addAttribute('label', $language->title);
					$field->addAttribute('translate_label', 'false');
					$field->addAttribute('extension', $extension);
					$field->addAttribute('edit', 'true');
					$field->addAttribute('clear', 'true');
				}
			}

			if ($add)
			{
				$form->load($addform, false);
			}
		}

		// Trigger the default form events.
		
		parent::preprocessForm($form, $data, $group);
	}

	
	
	
	/**
	 * Method to get the script that have to be included on the form
	 *
	 * @return string	Script files
	 */
	 
	 
	
	
	
	
	private function canCreateCategory()
	{
		return JFactory::getUser()->authorise('core.create', 'com_kelpie');
	}
}
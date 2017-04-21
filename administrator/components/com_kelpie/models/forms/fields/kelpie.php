<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
JFormHelper::loadFieldClass('list');
 
/**
 * HelloWorld Form Field class for the HelloWorld component
 *
 * @since  0.0.1
 */
class JFormFieldKelpie extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'Kelpie';
 
	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('#__kp_video.id as id,title_video,#__kp_category.name as category,catid');
		$query->from('#__kp_video');
		$query->leftJoin('#__kp_category on catid = #__kp_category.id');
		// Retrieve only published items
		$query->where('#__kp_video.published = 1');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();
 
		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->greeting .
				                      ($message->catid ? ' (' . $message->category . ')' : ''));
			}
		}
 
		$options = array_merge(parent::getOptions(), $options);
 
		return $options;
	}
}

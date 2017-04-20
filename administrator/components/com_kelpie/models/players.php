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
 
/**
 * HelloWorldList Model
 *
 * @since  0.0.1
 */
class KelpieModelPlayers extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'player.name.id',
				'name','player.name',
				'published', 'player.published'
			);
		}
 
		parent::__construct($config);
	}
	
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$user = JFactory::getUser();
		$app = JFactory::getApplication();
 
		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'player.id, player.name, player.published'
					
			)
		);;
				
		$query->from('#__kp_player AS player');
				
 
		
		// Filter by search in title.
		$search = $this->getState('filter.search');
		if (!empty($search)){
				$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
				$query->where('(player.name LIKE ' . $search. ')');
		}
		
		// Filter by a single or group of categories.
		$baselevel = 1;
		
		
		
		// Filter by published state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('player.published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(player.published = 0 OR player.published = 1)');
		}
 
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'player.id');
		$orderDirn 	= $this->state->get('list.direction', 'asc');
		
 
		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));		
 
		return $query;
	}
	
	public function getItems()
	{
		$items = parent::getItems();

		if (JFactory::getApplication()->isSite())
		{
			$user = JFactory::getUser();
			$groups = $user->getAuthorisedViewLevels();

			for ($x = 0, $count = count($items); $x < $count; $x++)
			{
				// Check the access level. Remove articles the user shouldn't see
				if (!in_array($items[$x]->access, $groups))
				{
					unset($items[$x]);
				}
			}
		}

		return $items;
	}
	
	
	
}
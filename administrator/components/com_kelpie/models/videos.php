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
class KelpieModelVideos extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'video.id',
				'title_video','video.title_video',
				'published', 'video.published',
				'catid', 'video.catid'
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
				'video.id,video.vote_good, video.title_video, video.published, video.catid'.
				',video.state'
					
			)
		);;
				
		$query->from('#__kp_video AS video');
		
		
		$query->select('categoria.title AS category_title')
			->join('LEFT', '#__categories AS categoria ON categoria.id = video.catid');
		
		
		// Filter by search in title.
		$search = $this->getState('filter.search');
		if (!empty($search)){
				$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
				$query->where('(video.title_video LIKE ' . $search. ')');
		}
		
		// Filter by a single or group of categories.
		$baselevel = 1;
		$categoryId = $this->getState('filter.category_id');

		if (is_numeric($categoryId))
		{
			$cat_tbl = JTable::getInstance('Category', 'JTable');
			$cat_tbl->load($categoryId);
			$rgt = $cat_tbl->rgt;
			$lft = $cat_tbl->lft;
			$baselevel = (int) $cat_tbl->level;
			$query->where('categoria.lft >= ' . (int) $lft)
				->where('categoria.rgt <= ' . (int) $rgt);
		}
		elseif (is_array($categoryId))
		{
			JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $categoryId);
			$query->where('video.catid IN (' . $categoryId . ')');
		}
		
		
		
		// Filter by published state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('video.published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(video.published = 0 OR video.published = 1)');
		}
 
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'video.id');
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
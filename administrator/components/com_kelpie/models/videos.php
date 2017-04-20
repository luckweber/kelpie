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
		$app = JFactory::getApplication();
		$context = "kelpie.list.admin.kelpie";
		
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
		
		
		// Filter company
		$categories= $db->escape($this->getState('filter.company'));
		if (!empty($company)) {
			$query->where('(video.catid='.$categories.')');
		}
		
		
		$query->select('categoria.name AS category_title')
			->join('LEFT', '#__kp_category AS categoria ON categoria.id = video.catid');
		
		
		// Filter by search in title.
		$search = $this->getState('filter.search');
		if (!empty($search)){
				$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
				$query->where('(video.title_video LIKE ' . $search. ')');
		}
		
		// Filter by a single or group of categories.
		$baselevel = 1;
		$categoryId = $this->getState('filter.catid');
		
		
		if (!empty($search)){
				$query->where('(video.catid = categoria.id)');
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
	
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');
 
		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		//Omit double (white-)spaces and set state
		$this->setState('filter.search', preg_replace('/\s+/',' ', $search));
 
		//Filter (dropdown) state
		$state = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $state);
 
		//Filter (dropdown) company
		$company= $app->getUserStateFromRequest($this->context.'.filter.cat', 'filter_cat', '', 'string');
		$this->setState('filter.cat', $company);
 
		//Takes care of states: list. limit / start / ordering / direction
		parent::populateState('video.title_video', 'asc');
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
			$items = KelpieModelVideos::getCategories( $exclude_category );
		} else {
			$items = KelpieModelVideos::getCategories();
		}
		
		foreach( $items as $item ) {
			$item->treename = JString::str_ireplace( '&#160;', '-', $item->treename );
			$value = ( 'category' == $name || 'filter_category' == $name ) ? $item->name : $item->id;
			
			$options[] = JHTML::_( 'select.option', $value, $item->treename );
		}
		
		return JHTML::_( 'select.genericlist', $options, $name, $script, 'value', 'text', $selected );

	}
	
	
	
}
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

JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');
jimport( 'joomla.html.html.jgrid' );

JHtml::_('formbehavior.chosen', 'select');


$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);


$doc = JFactory::getDocument();

//$doc->addStyleSheet( "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", "text/css", "screen" );
$doc->addStyleSheet( JURI::root()."administrator/components/com_kelpie/assets/css/kelpie.css", "text/css", "screen" );


//$doc->addScript("https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" );
//$doc->addScript("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" );
$doc->addScript( JURI::root()."administrator/components/com_kelpie/assets/js/kelpie.js" );


//JHTML::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');

?>


<div class="kelpie_painel">

	<div class="kelpie_sidebar">
		<ul class="nav nav-list">
			<li ><a href="index.php?option=com_kelpie">DashBoard</a></li>
			<li class="active"><a href="index.php?option=com_kelpie&view=categories">Categories</a></li>
			<li ><a href="index.php?option=com_kelpie&view=videos">Videos</a></li>
			<li ><a href="index.php?option=com_kelpie&view=players">Players</a></li>

		</ul>
	</div>
	<div class="kelpie_content">
		<form action="index.php?option=com_kelpie&view=categories" method="post" id="adminForm" name="adminForm">
	<div class="row-fluid">
		<div class="span6">
			<?php echo JText::_('COM_KELPIE_VIDEOS_FILTER'); ?>
			<?php
				echo JLayoutHelper::render(
					'joomla.searchtools.default',
					array('view' => $this)
				);
			?>
		</div>
	</div>
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo JText::_('COM_KELPIE_VIDEOS_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="90%">
				<?php echo JHtml::_('grid.sort', 'COM_KELPIE_VIDEOS_NAME', 'title_poesia', $listDirn, $listOrder); ?>

			</th>
			<th width="5%">
				<?php echo JHtml::_('grid.sort', 'COM_KELPIE_VIDEOS_PUBLISHED', 'published', $listDirn, $listOrder); ?>

			</th>
			<th width="2%">
				<?php echo JHtml::_('grid.sort', 'COM_KELPIE_VIDEOS_ID', 'id', $listDirn, $listOrder); ?>

			</th>
			
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
					$link = JRoute::_('index.php?option=com_kelpie&task=category.edit&id=' . $row->id);
				?>
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_HELLOWORLD_EDIT_HELLOWORLD'); ?>">
								<?php echo $row->name; ?>
							</a>
						</td>
						<td align="center">
							<?php echo JHtml::_('jgrid.published', $row->published, $i, 'categories.', true, 'cb'); ; ?>
						</td>
						<td align="center">
							<?php echo $row->id; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>

	</div>
	
	
	
	
</div>

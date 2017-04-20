<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_semanafluminense
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access
defined('_JEXEC') or die('Restricted access');
//validador
JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');
JHtml::_('behavior.formvalidator');
//JHtml::_('bootstrap.loadCss');

$doc = JFactory::getDocument();
//$doc->addScript( JURI::root()."administrator/components/com_kelpie/assets/js/kelpie_video.js" );


?>
<form action="<?php echo JRoute::_('index.php?option=com_kelpie&view=category&layout=edit&id=' . (int) $this->item->id); ?>"
     method="post" name="adminForm" id="adminForm" class="form-validate">
	
	<?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
	<?php echo $this->form->renderField('type'); ?>

    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_KELPIE_PLAYER_DETAILS'); ?></legend>
			
			
			<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', empty($this->item->id) ? JText::_('COM_KELPIE_PLAYER_DETAILS_ADD') : JText::_('COM_KELPIE_PLAYER_DETAILS_EDIT')); ?>
		<div class="row-fluid">
			<div class="span9">
				<div class="form-vertical">
					<div id="list_video_option">
						<div>
								
						</div>
						<div>

						</div>
					</div>	
					
					<?php echo $this->form->renderField('width'); ?>
					<?php echo $this->form->renderField('height'); ?>
					
				</div>
			</div>
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>

			</div>
			
			<div class="span2">
				


			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
        </fieldset>
    </div>
    <input type="hidden" name="task" value="foto.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>
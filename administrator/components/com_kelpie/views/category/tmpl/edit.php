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


$doc = JFactory::getDocument();
$doc->addScript( JURI::root()."administrator/components/com_kelpie/assets/js/kelpie.js" );


?>
<form action="<?php echo JRoute::_('index.php?option=com_kelpie&view=category&layout=edit&id=' . (int) $this->item->id); ?>"
     method="post" name="adminForm" id="adminForm" class="form-validate">
														<?php echo $this->form->renderField('name'); ?>

    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_KELPIE_CATEGORY_DETAILS'); ?></legend>
			
			<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', empty($this->item->id) ? JText::_('COM_KELPIE_CATEGORY_DETAILS_ADD') : JText::_('COM_KELPIE_CATEGORY_DETAILS_EDIT')); ?>
		<div class="row-fluid">
			<div class="span9">
				<div class="form-vertical">
					<div id="list_video_option">
						<div>

						</div>
						<div>
							
						</div>
					</div>		
					<?php echo $this->form->renderField('metakeywords'); ?>
					
				</div>
			</div>
			<div class="span3">
				<label class="control-label" for="parent"><?php echo JText::_( 'PARENT' ); ?></label>
					<?php echo $this->full;?>

				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>

			</div>
			
			<div class="span2">
				


			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		

        </fieldset>
    </div>

    <input type="hidden" name="task" value="category.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>
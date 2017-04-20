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
$doc->addScript( JURI::root()."administrator/components/com_kelpie/assets/js/kelpie_video.js" );
$doc->addStyleSheet( JURI::root()."administrator/components/com_kelpie/assets/css/kelpie.css" );



?>
<form action="<?php echo JRoute::_('index.php?option=com_kelpie&view=category&layout=edit&id=' . (int) $this->item->id); ?>"
     method="post" name="adminForm" id="adminForm" class="form-validate">
	
	<?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_KELPIE_VIDEO_DETAILS'); ?></legend>
			
			
			<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', empty($this->item->id) ? JText::_('COM_KELPIE_VIDEO_DETAILS_ADD') : JText::_('COM_KELPIE_VIDEO_DETAILS_EDIT')); ?>
		<div class="row-fluid">
			<div class="span9">
				<div class="form-vertical">
					<?php echo $this->form->renderField('title_video'); ?>
					<?php echo $this->form->renderField('type_video'); ?>
					
					<div id="upload_list">
						
						<input type="hidden"  class="pathfile" value="<?php echo JPATH_ROOT;?>"/>
						<input type="hidden"  class="getclass" value=""/>

						<?php 
						
							
						?>	
						<div>
							<?php echo $this->form->getInput('url_video'); ?>
							<?php echo $this->form->getInput('url_hd_video'); ?>
							<?php echo $this->form->getInput('thumb_video'); ?>
							<?php echo $this->form->getInput('preview_video'); ?>
						</div>
						
						<div id="ajaxcontainer"></div>
						
						
						<!-- The Modal -->
						<div id="myModal" class="kelpie_modal">

						  <!-- Modal content -->
						  <div class="kelpie_modal-content">
							<div class="kelpie_modal-header">
							  <span class="close">&times;</span>
							  <h2>Upload File</h2>
							</div>
							<div class="kelpie_modal-body">
								<p class="msn_error">Error Upload</p>	
								<p class="msn_sucess">Sucess Upload</p>
							  <div class="panel_upload_input">
								<input type="file" class="upload_browser" />
								<p><input type="text" class="msn_upload1"/><button class="button_browser btn-success">Upload</button></p>
								<p><button class="button_send">Send</button><button class="button_close">Close</button></p>
							</div>
							 
							</div>
							<div class="kelpie_modal-footer">
							  <h3></h3>
							</div>
						  </div>
						</div>
						
						<div class="kelpie_modal_loading"><!-- Place at bottom of page --></div>


					</div>
					
					<?php echo $this->form->renderField('text_video'); ?>
				</div>		
			</div>	
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>

			</div>
			
			<div class="span2">
				<?php echo $this->form->getLabel('vote_good'); ?>
				<?php echo $this->form->getInput('vote_good'); ?>


			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'images', JText::_('JGLOBAL_FIELDSET_IMAGE_OPTIONS')); ?>
<div class="row-fluid">
			<div class="span6">
					<?php echo $this->form->renderField('images'); ?>
					<?php foreach ($this->form->getGroup('images') as $field) : ?>
						<?php echo $field->renderField(); ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'autor', JText::_('COM_SEMANAFLUMINENSE_ABA_AUTOR')); ?>
    		
		<div class="row-fluid">
			<div class="span6">
					<?php echo $this->form->renderField('autor_nome_poesia'); ?>
					<?php echo $this->form->renderField('autor_nome_artistico_poesia'); ?>
					<?php echo $this->form->renderField('autor_data_nascimento_poesia'); ?>

				</div>
			</div>	
			<?php echo JHtml::_('bootstrap.endTab'); ?>
<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('COM_CONTENT_FIELDSET_PUBLISHING')); ?>
			<div class="row-fluid form-horizontal-desktop">
				<div class="span6">
					<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
				
				</div>
				<div class="span6">
					<?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
				</div>
			</div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
        </fieldset>
    </div>
    <input type="hidden" name="task" value="video.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>

<?php
defined('JPATH_BASE') or die;
 
jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');


class JFormFieldPeriodlist extends JFormFieldList
{
   protected $type = 'Periodlist';
 
   protected function getOptions() 
   {
      $db = JFactory::getDBO();
      $query = $db->getQuery(true);
      $query->select('id, title-video');
      $query->from('#__video');
      $db->setQuery((string)$query);
      $messages = $db->loadObjectList();
      $options = array();
      if ($messages)
      {
         foreach($messages as $message) 
         {
            $options[] = JHtml::_('select.option', $message->id, $message->name);
         }
      }
      $options = array_merge(parent::getOptions(), $options);
      return $options;
   }
}

?>
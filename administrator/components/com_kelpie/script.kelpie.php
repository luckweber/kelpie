<?php

/*
 * @version		$Id: script.allvideoshare.php 3.0 2017-01-26 $
 * @package		All Video Share
 * @copyright   Copyright (C) 2012-2017 MrVinoth
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class com_KelpieInstallerScript{
	
	
	function postflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		// Install modules
		
		$status = new JObject();
		$status->modules = array();
		$status->plugins = array();
		$src = $parent->getParent()->getPath( 'source' );
        $manifest = $parent->getParent()->manifest;
		
		
        $modules = $manifest->xpath( 'modules/module' );
        foreach( $modules as $module ) {
            $name = (string) $module->attributes()->module;
            $client = (string) $module->attributes()->client;
            $path = $src.'/modules/'.$name;
            $installer = new JInstaller;
            $result = $installer->install( $path );
            $status->modules[] = array( 'name' => $name, 'client' => $client, 'result' => $result );
        }
		//echo '<p>' . JText::_('COM_HELLOWORLD_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
		
		$this->installationResults( $status );
		   

	}
	
	public function installationResults( $status ) {
	
		$language = JFactory::getLanguage();
        $language->load( 'com_allvideoshare' );
		?>
  		<table class="table table-striped">
    	  <thead>
      		<tr>
        	  <th colspan="2"><?php echo JText::_( 'EXTENSION' ); ?></th>
        	  <th width="30%"><?php echo JText::_( 'STATUS' ); ?></th>
     		</tr>
    	  </thead>
    	  <tbody>
      		<tr>
        	  <td colspan="2"><?php echo 'Kelpie - '.JText::_( 'COMPONENT' ); ?></td>
        	  <td><strong><?php echo JText::_( 'INSTALLED' ); ?></strong></td>
      		</tr>
            
      		<?php if( count( $status->modules ) ) : ?>
      			<tr>
        	  		<th><?php echo JText::_( 'MODULE' ); ?></th>
        	  		<th><?php echo JText::_( 'CLIENT' ); ?></th>
        	  		<th></th>
      			</tr>
      			<?php foreach( $status->modules as $module ) : ?>
      				<tr>
        	  			<td><?php echo $module['name']; ?></td>
        	  			<td><?php echo ucfirst( $module['client'] ); ?></td>
        	  			<td><strong><?php echo ( $module['result'] ) ? JText::_( 'INSTALLED' ) : JText::_( 'NOT_INSTALLED' ); ?></strong></td>
      				</tr>
      			<?php endforeach;?>
      		<?php endif;?>
            
    	  </tbody>
  		</table>
		<?php
		
	}
	
	
	
}
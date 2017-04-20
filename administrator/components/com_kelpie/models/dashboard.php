<?php

/*
 * @version		$Id: model.php 3.0 2017-01-10 $
 * @package		Joomla
 * @copyright   Copyright (C) 2012-2017 MrVinoth
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class KelpieModelDashBoard extends JModelLegacy {

	public function getServerDetails() {
	
        $allow_fileuploads = ini_get( 'file_uploads' ) ? JText::_( 'ALL_VIDEO_SHARE_YES' ) : JText::_( 'ALL_VIDEO_SHARE_NO' );
		$upload_max_filesize = ini_get( 'upload_max_filesize' );
		$max_input_time = ini_get( 'max_input_time' );
		$memory_limit = ini_get( 'memory_limit' );
		$max_execution_time = ini_get( 'max_execution_time' );
		$post_max_size = ini_get( 'post_max_size' );
            
		$output[0] = array( 'name' => JText::_( 'ALLOW_FILE_UPLOADS' ), 'value' => $allow_fileuploads );
		$output[1] = array( 'name' => JText::_( 'UPLOAD_MAX_FILESIZE' ), 'value' => $upload_max_filesize );
		$output[2] = array( 'name' => JText::_( 'MAX_INPUT_TIME' ), 'value' => $max_input_time );
		$output[3] = array( 'name' => JText::_( 'MEMORY_LIMIT' ), 'value' => $memory_limit );
		$output[4] = array( 'name' => JText::_( 'MAX_EXECUTION_TIME' ), 'value' => $max_execution_time );
		$output[5] = array( 'name' => JText::_( 'POST_MAX_SIZE' ), 'value' => $post_max_size );

        return $output;
		
	}
}
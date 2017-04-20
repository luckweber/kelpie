<?php 


if(isset($_FILES['fileUpload'])){
	date_default_timezone_set("Brazil/East");
	$ext = strtolower(substr($_FILES['fileUpload']['name'],-4));
	$name = explode('.',$_FILES['fileUpload']['name']);
	$new_name = date("Y.m.d-H.i.s")."_" . $name[0].$ext;
	$path = urldecode($_POST['path']);
	$dir = $path.'/media/com_kelpie/';
	if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name)){
			
			//echo $dir.$new_name;
			
			if($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME']== "127.0.0.1"){
				$part = explode("\\", $path);
				$num = count($part);
				
				echo "http://localhost/".$part[--$num]."/media/com_kelpie/".$new_name;
				
				
				
			}else{
				echo $dir.$new_name;
			}
			
			
	}else{
	
		echo "Error Upload";
	}
	//echo dirname(__FILE__);
	//echo getcwd();
	//echo urldecode($_POST['path']);
}


?>
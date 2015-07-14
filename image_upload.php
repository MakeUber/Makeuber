<?php
include "init.php";
		$validimages=array("jpg","gif","png","jpeg","bmp");
		$ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
		if(in_array($ext,$validimages))

		{
	
			if($_FILES['upload']['tmp_name'] <> ''){
			 $type=explode('/',$_FILES['upload']['type']);
			 $image_name= "st_".time()."_".$_FILES['upload']['name']; 
			 $path = "ckeditorimages/".$image_name;
			 chmod("$path",0777);  // set permission to the file.
			 if(copy($_FILES['upload']['tmp_name'], $path))//  upload the file to the server
			 {
			
			 $url = ROOT_URL.$path;
			// echo $url;die;
			 }
			}

			else

			{

				$message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";	

			}

		}

		else

		{

			$message = "Only images file with ".implode(",",$validimages)." extensions are allowed";	

		}

		 $funcNum = $_GET['CKEditorFuncNum'] ;

echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
?>
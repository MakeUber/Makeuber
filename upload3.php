<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");

//If directory doesnot exists create it.
$output_dir = "img/";
$uniq =$_GET['id'];
if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
       	 	$fileName = $_FILES["myfile"]["name"];
	
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
			 	 ////////////////////////////////////////////////////////////////////////////////////////
				 
				 $allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
				 $file_field = 'myfile';
				 $validate = validate_file($file_field, $allowed_ext, '0', '1');
				 $ext = $validate[2];
				 $rand1 = random_generator(10);
				 $image_name = $rand1.'.'.$ext;
				 $path = "img/".$image_name;
				 
				 
			  copy($_FILES["myfile"]["tmp_name"], $path);     //  upload the file to the server
    			  chmod("$path",0777);                 // set permission to the file.                // set permission to the file.
				 $thumb = 'img/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				//$max_width=650; // Fix the width of the thumb nail images
				//$max_height=400; // Fix the height of the thumb nail imaage
				
				///////////////////////////////////////////New height and width of the image //////////////////////////
				
				$max_width=270; // Fix the width of the thumb nail images
				$max_height=270; // Fix the height of the thumb nail imaage
				$this_image = "img/".$image_name;
				
				list($width, $height, $type, $attr) = getimagesize("$this_image");
				
				if ($width > $height) {
				$image_height = floor(($height/$width)*$new_width);
				$image_width  = $new_width;
				} else {
				$image_width  = floor(($width/$height)*$new_height);
				$image_height = $new_height;
				}		
				$max_width=$image_width; // Fix the width of the thumb nail images
				$max_height=$image_height; // Fix the height of the thumb nail imaage

				
				
				///////////////////////////////////////////////////////End of new height and width ///////////////////////////////
				
							$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");
			 ///////////////////////////////////////////////////////////////////////////////////////
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$fileName;
				 
				 
	$add_dvar = array('images_id' => $uniq, 'image' => $image_name, 'status' => '1', 'time' => time());
				 list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar );
			
			$sql_gal = "INSERT into project_images(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from project_images"; 
			$fg = 'ad';
			mysql_query($sql_gal);
			
    	}
    	else
    	{
    	    	$fileCount = count($_FILES["myfile"]['name']);
    		  for($i=0; $i < $fileCount; $i++)
    		  {
    		  	$fileName = $_FILES["myfile"]["name"][$i];
				
				 ////////////////////////////////////////////////////////////////////////////////////////
				 $allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
	$file_field = 'image_name';
				 $validate = validate_file($file_field, $allowed_ext, '0', '1');
				 $ext = $validate[2];
				 $rand1 = random_generator(10);
			$image_name = $rand1.'.'.$ext;
			$path = "img/".$image_name;
				 
				 
			  copy($_FILES["myfile"]["tmp_name"], $path);     //  upload the file to the server
    			  chmod("$path",0777);                 // set permission to the file.                // set permission to the file.
				 $thumb = 'img/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				
				///////////////////////////////////////////New height and width of the image //////////////////////////
				
				$max_width=270; // Fix the width of the thumb nail images
				$max_height=270; // Fix the height of the thumb nail imaage
				$this_image = "img/".$image_name;
				
				list($width, $height, $type, $attr) = getimagesize("$this_image");
				
				if ($width > $height) {
				$image_height = floor(($height/$width)*$new_width);
				$image_width  = $new_width;
				} else {
				$image_width  = floor(($width/$height)*$new_height);
				$image_height = $new_height;
				}		
				$max_width=$image_width; // Fix the width of the thumb nail images
				$max_height=$image_height; // Fix the height of the thumb nail imaage

				
				
				///////////////////////////////////////////////////////End of new height and width ///////////////////////////////
				
							$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");
			 ///////////////////////////////////////////////////////////////////////////////////////
				
	       	 	 $ret[$fileName]= $output_dir.$fileName;
			
    		     copy($_FILES["myfile"]["tmp_name"], $path);     //  upload the file to the server
    			  chmod("$path",0777);                 // set permission to the file.                // set permission to the file.
				 $thumb = 'img/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				//$max_width=650; // Fix the width of the thumb nail images
				//$max_height=400; // Fix the height of the thumb nail imaage
				
				///////////////////////////////////////////New height and width of the image //////////////////////////
				
				$max_width=270; // Fix the width of the thumb nail images
				$max_height=270; // Fix the height of the thumb nail imaage
				$this_image = "img/".$image_name;
				
				list($width, $height, $type, $attr) = getimagesize("$this_image");
				
				if ($width > $height) {
				$image_height = floor(($height/$width)*$new_width);
				$image_width  = $new_width;
				} else {
				$image_width  = floor(($width/$height)*$new_height);
				$image_height = $new_height;
				}		
				$max_width=$image_width; // Fix the width of the thumb nail images
				$max_height=$image_height; // Fix the height of the thumb nail imaage

				
				
				///////////////////////////////////////////////////////End of new height and width ///////////////////////////////
							$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");
				 
				$add_dvar = array('images_id' => $uniq, 'image' => $image_name, 'status' => '1', 'time' => time());
				 list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar );
			
	echo		$sql_gal = "INSERT into project_images(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from project_images";
			$fg = 'ad';
			mysql_query($sql_gal);
				
    		  }
    	
    	}
    }
    echo json_encode($ret);
 
}

?>
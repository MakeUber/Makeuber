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
				
				
				
				///////////////////////////////////////////////////////End of new height and width ///////////////////////////////
				
				$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");
			 ///////////////////////////////////////////////////////////////////////////////////////
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$fileName;
				 
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
							
				///////////////////////////////////////////////////////End of new height and width ///////////////////////////////
				$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");
				 
			
    		  }
    	
    	}
    }
	$sql_design = "select * from category where status='1'";
	$exec_design = mysql_query($sql_design);
	while($fetch_design = mysql_fetch_assoc($exec_design)){
		$tag[] = $fetch_design['category_name'];	
	}
    echo json_encode(array("image"=> $image_name, "design" => $tag));
 
}

?>
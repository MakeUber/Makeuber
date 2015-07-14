<?php
include "init.php";
include "config_db.php";
include "config.php";
	if(is_array($_FILES)){
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])){
			/*$sourcePath = $_FILES['userImage']['tmp_name'];
			$targetPath = "img/".$_FILES['userImage']['name'];
				if(move_uploaded_file($sourcePath, $targetPath)){
					echo '<div class="alert alert-success alert-dismissible col-sm-4 fade" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Image successfully updated!
						</div>';
				}*/
				
				$fileName = $_FILES["userImage"]["name"];
	
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
			 	 ////////////////////////////////////////////////////////////////////////////////////////
				 
				 //$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
				 $file_field = 'userImage';
				// $validate = validate_file($file_field, $allowed_ext, '0', '1');
				 //$ext = $validate[2];
				 //$rand1 = random_generator(10);
				 $image_name = $fileName;
				 $path = "img/".$image_name;
				 
				 
			  copy($_FILES["userImage"]["tmp_name"], $path);     //  upload the file to the server
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
				 	echo '<div class="alert alert-success alert-dismissible col-sm-4 fade" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Image successfully updated!
						</div>';
		}
	}
?>
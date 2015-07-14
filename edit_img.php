<?php
	require_once("init.php");
	require_once("config_db.php");
	require_once("config.php");
$tabl = 'project_images';

 $id = mysql_real_escape_string($_GET['id']);
 $imid = mysql_real_escape_string($_GET['imid']);
$relation = mysql_real_escape_string($_GET['relation']);
$item = "Image";
$page_parent='add_project.php?do=edit&id='.$id.'';

if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='".$id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	//print_r($fetch);
	//$image = $fetch['image'];
	$dvar['image_name'] = $fetch['image_name'];
	$dvar['image'] = $fetch['image'];
	$dvar['description'] = $fetch['description'];
	$dvar['images_id'] = $fetch['images_id'];

}


if(isset($_POST['submitbut'])){
	//print_r($_POST);die;
	$dvar['image_name'] = $_POST['image_name'];
	$dvar['description'] = $_POST['description'];
	$dvar['image_delete'] = $_POST['image_delete'];
	$dvar['images_id'] = $_POST['images_id'];
	$imid = $_POST['id'];
	/*if($dvar['image_name'] == ''){
		$flag[92] = 'r';
		}
    else if($dvar['description'] == ''){
		$flag[31] = 'r';
		}*/
	$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
	$file_field = 'image';
	

	$do = $_GET['do'];
	if($do == 'edit'){
		$validate = validate_file($file_field, $allowed_ext, '0', '0');
	}
	else{
		$validate = validate_file($file_field, $allowed_ext, '0', '1');
	}
	//for image1
	if($validate[0] <> '1'){
		$flag['file'] = $validate[0];
	}
	else if($validate[1] <> ''){
		$file = '1';
		$ext = $validate[2];
	}
	if(!empty($flag)){
		$flag_r = 'r';
	}
	else{
		if($file == '1'){
			$rand1 = random_generator(10);
			$image_name = $rand1.'.'.$ext;
			$path = "img/".$image_name;
		}
		if($do == 'edit'){
		$sql_s = "select * from $tabl where id='".$imid."'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);
			
			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('img/'.$fetch_s[$file_field]);
				$image_name = '';
				$sql_file = "$image_name";
				$sql_file1 = "$image_name";
			}
			if($file == '1'){
				unlink('img/'.$fetch_s[$file_field]);
				//unlink('thumb/'.$fetch_s[$file_field]);
				$sql_file = "$image_name";
				//$sql_file1 = "$image_name";
			}
			if($dvar['image_delete'] <> 1 && $file <> '1'){ 
				$sql_file = $fetch_s['image'];
				//$sql_file1 = $fetch_s['image'];
			}
			
			$add_dvar = array('image' => $sql_file, 'time' => time());
			$remove_dvar = array('image_delete',);
//			$change_dvar = array('status' => '0');
			
			$sql_gal = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$imid."'";
			$fg = 'ed';
			
		}
		else{
			
			$uniq = random_generator(10);
			$add_dvar = array('image' => $image_name, 'status' => '1', 'time' => time());
			
			$remove_dvar = array('image_delete','image_delete2');
//			$change_dvar = array('status' => '1');

			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
			$sql_gal = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
			$fg = 'ad';
		
			
		}
		//echo $_FILES[$file_field][name];die;
		if(mysql_query($sql_gal)){
			if($file == '1'){
				 copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
    			  chmod("$path",0777);                 // set permission to the file.                // set permission to the file.
				 $thumb = 'img/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				//$max_width=800; // Fix the width of the thumb nail images
				//$max_height=500; // Fix the height of the thumb nail imaage
				///////////////////////////////////////////New height and width of the image //////////////////////////
				
				$max_width=270; // Fix the width of the thumb nail images
				$max_height=270; // Fix the height of the thumb nail imaage
				$this_image = "img/".$image_name;
			
				$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");   // set permission to the file.
			}
			$flag[$fg] = $item;
			"location:designer_profile.php";
			
		}
		else{
			echo mysql_error();//$flag['q'] = 'r';
		}
	}
	}
	if($_GET['do'] == 'edit' && ($flag[$fg] <> '')){
	$sql = "SELECT * from $tabl where id='".$imid."'"; 
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$image = $fetch['image'];
	$dvar['image_name'] = $fetch['image_name'];
	$dvar['image'] = $fetch['image'];
	$dvar['description'] = $fetch['description'];
}

//////////////////////////////////// Manage Design Section ////////////////////////////////////////
$sql_category = "select * from category where status='1'";
$exec_category = mysql_query($sql_category);

//print_r($fetch);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
	<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="css/style.css">
<link rel ="stylesheet" href="css/font-awesome.min.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src = "js/jquery-ui.min.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.uploadfile.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/uploadfile.css">
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<?php    if($flag[$fg] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=edit_project.php?do=edit&id=<?php echo $fetch['images_id'];?>">
<?php } ?>
</head>

<style type="text/css">
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle=tooltip]').tooltip();
	});
</script>

<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">
<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<?php include "./include/header.php" ?> 
<!-- ---------------------Main ------------------------------- -->
<div id="main" style="background:#fff;margin:20px;height:auto;width:95vw;opacity:1;padding:20px;text-align:center;">
	<h2 style="color:#C16700;">Edit Image</h2>
	<?php echo print_messages($flag, $error_message, $success_message);?> 	

	<form action="<?php echo $_SERVER['PHP_SELF'];?>?do=edit&id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
    <div style="margin:20px;padding:20px;margin-left:150px;n">
		<div style="float:left;">
			<img src="img/<?php if($dvar['image']==''){ echo 'no_img.jpg'; }else{ echo $dvar['image'];}?>" height="200px" width="200px"><br><br>
<!--			<button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Change previous image">Upload Image</button>
-->            <input type="file" name="image" class="btn btn-warning" style="width:200px">
		</div>
		<div style="margin-left:20px;width:500px;float:left;text-align:left;font-size:14px;">
            <select class="form-control"  name="image_name">
            <option value="">Select Tag</option>
                <?php 
				while($fetch_category = mysql_fetch_assoc($exec_category)){
				?>
                <option value="<?php echo $fetch_category['category_name'];?>" <?php 
				if (strpos($fetch_category['category_name'],$dvar['image_name']) !== false) { echo "selected='selected'";}
				?>><?php echo $fetch_category['category_name'];?></option>
                <?php }?>
                </select>
            <br>
            <input type="hidden" name="images_id" value="<?php echo $dvar['images_id'];?>">
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
			Image Description<br>
			<textarea rows="3" class="form-control" placeholder="Previous Description goes here" data-toggle="tooltip" name="description" data-placement="top" title="You can change description here"><?php echo $dvar['description'] ;?></textarea><br>
			<button type="submit" name="submitbut" class="btn btn-primary">Save</button>&nbsp;&nbsp;
			<a href="edit_project.php?do=edit&id=<?php echo $fetch['images_id'];?>" class="btn btn-primary">Back</a>
		</div>
	</div>
       </form>
    <div style="clear:both;"></div>
</div>

<!-- ---------------------Footer ------------------------------- -->
<?php include "include/footer.php";?>
		
</body>
</html>
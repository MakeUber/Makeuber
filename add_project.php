<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
	
$tabl = 'project';
$tab2 = 'project_images';
$namep = $_SERVER['PHP_SELF'];
$id = mysql_real_escape_string($_GET['id']);
$do = $_GET['do'];
$relation = mysql_real_escape_string($_GET['relation']);
$item = "Project";
$page_parent='designer_profile.php';
/*	$sql = "SELECT * from $tabl";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['id'] = $fetch['id'];
	*/	
 $sql2 = "SELECT * from $tab2 where images_id='".$id."' order by sort ASC";
 $exec2 = mysql_query($sql2) or die(mysql_error());
$category="select * from category";
$select=mysql_query($category);	

	if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='".$id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$image = $fetch['project_image'];
	$dvar['project_name'] = $fetch['project_name'];
	$dvar['project_image'] = $fetch['project_image'];
	$description = $fetch['description'];
	
	
	$dvar['id'] = $fetch['id'];
}
if(isset($_POST['submitbut'])){
	//print_r($_FILES);die;
	$dvar['project_name'] = $_POST['project_name'];
	$dvar['description'] = $_POST['description1'];
	if($_FILES['project_image1']['name'] == ''){
	$dvar['project_image'] = $_POST['project_image'];
}
	$image_names = $_POST['image_name'];
	$image_description = $_POST['description'];
	$image = $_POST['image'];
	//print_r($image);die;
	$dvar['id'] = $fetch['id'];
	$dvar['user_id'] = $user_uniq;
	if($dvar['project_name'] == ''){
		$flag[92] = 'r';
		}
		
	if(!empty($flag)){
		$flag_r = 'r';
	}
	else{
		
		/*if($do == 'edit'){
		
			$add_dvar = array('project_image' => $sql_file, 'time' => time());
			$remove_dvar = array('image_delete',);
//			$change_dvar = array('status' => '0');
			
			$sql_gal = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";
			$fg = 'ed';
		}
		else{
			*/
			if($_FILES['project_image1']['name'] <> ''){
				$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
				$file_field = 'project_image1';
				$validate = validate_file($file_field, $allowed_ext, '0', '0');
				
				//for image1
				if($validate[0] <> '1'){
					$flag['file'] = $validate[0];
				}
				else if($validate[1] <> ''){
					$file = '1';
					$ext = $validate[2];
				}
				
				if($file == '1'){
					$rand1 = random_generator(10);
					$image_name = $rand1.'.'.$ext;
					$path = "img/".$image_name;
				}
			//print_r($add_dvar);
		
			}
			//die;
			$uniq = random_generator(10);
			
			if($_FILES['project_image1']['name'] <> ''){
				$add_dvar = array('project_image' => $image_name, 'status' => '1', 'time' => time());
			}else{
				$add_dvar = array('status' => '1', 'time' => time());
			}
			
			
//			$remove_dvar = array('image_delete','image_delete2');
//			$change_dvar = array('status' => '1');

			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
	$sql_gal = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl"; 
			$fg = 'ad';
		//}
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
			$images_id = mysql_insert_id();
			$time = time();
			//echo $image_name;die;
			foreach($image_names as $k=>$v){
				$sql_img="insert into project_images(sort,images_id,image_name,image,description,status,time) select max(sort)+1,'$images_id','".$v."','".$image[$k]."','".$image_description[$k]."','1','$time' from project_images";
				if(!mysql_query($sql_img)){ echo mysql_error();}	
				header("location:designer_profile.php");
			}
				header("location:designer_profile.php");
		}
		else{
			echo mysql_error();//$flag['q'] = 'r';
		}
	}
	}
	if($_GET['do'] == 'edit' && ($flag[$fg] <> '')){
	$sql = "SELECT * from $tabl where id='$id'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$image = $fetch['project_image'];
	$dvar['project_name'] = $fetch['project_name'];
	$dvar['project_image'] = $fetch['project_image'];
	$dvar['description'] = $fetch['description'];
}
//for delete project images
if($_GET['do']=='delete') {
	$id=$_GET['id']; $imid=$_GET['imid'];
	 $sql="select * from project_images where id='$imid'";
	$exe=mysql_query($sql);
	while($fetch_img=mysql_fetch_assoc($exe)){
		unlink('img/'.$fetch_img['image']);
				}
		//delete from database
	$sql_img_del="delete from project_images where id='".$imid."'";
		if(mysql_query($sql_img_del)){
		$flag['d'] = $item2;
		header("location:add_project.php?do=edit&id=".$id."");
	}
	else{
		$flag['q'] = 'r';
	}
	}
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
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="cssp/font-awesome.min.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src = "js/jquery-ui.min.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.uploadfile.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/uploadfile1.css">
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/addproject.js"></script>
<style>
.footer-menu li a:hover{color:white; text-decoration:none; }
</style>

</head>

<style type="text/css">
	.drag-n-drop{
		height: 140px;
		width: 400px;
		padding: 20px;
		text-align: center;
		border: 2px dotted #888;
		color: #aaa;
		margin-left:10px;
	}
	.alert{
		position: fixed;
		top:40px;
		right: 40px;
		width: 300px;
		z-index: 30;
	}
	.uploaded-area{
		width: 900px;
	}
	.uploaded-img{
		float: left;
		width: 250px;
		margin: 10px;
		padding: 10px;
		font-size: 12px;
		border: 1px solid #999;
		box-shadow: 0 0 1px 1px #ccc;
	}
	.uploaded-img .form-control{
		font-size: 12px;
	}
	.uploaded-img input{
		height: 28px;
		margin-bottom: 10px;
	}
	.uploaded-img img{
		width: 200px;
		height: 180px;
		margin: 0 0 10px 10px;
	}

</style>

<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<?php include "./include/header.php" ?>
<!-- ---------------------Main ------------------------------- -->
<div id="main" style="background:#fff;margin:20px;height:auto;width:95vw;opacity:1;padding:20px;padding-left:80px;">
	<div style="margin-top:60px;height:200px;float:left;width:180px;border:1px solid rgba(255,255,255,0.5);box-shadow: 0 0 2px 2px rgba(0,0,0,0.2);padding:7px;padding-bottom:20px;text-align:center;">
		<img src = "img/<?php if(empty($fetch_user['image'])){ echo 'no_img.jpg'; }else{ echo $fetch_user['image'];}?>" height="100%" width="100%">
		<span style="display:block;font-size:14px;"><?php echo $fetch_user['first_name']." ".$fetch_user['last_name'];?></span>
	</div>
	<div style="float:left;margin-left:60px;">
		<h2 style="color:#C16700;margin:10px;margin-bottom:28px;">Add Projects</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
		<input type="text" class="form-control" style="margin:10px;width:500px;" required name="project_name" value="<?php echo $dvar['project_name'];?>" placeholder="Name Of Project">
		<textarea placeholder="Description" name="description1" style="margin:10px;width:500px;"  class="form-control" rows="4"><?php echo $description1 ;?></textarea>
		<div class="drag-n-drop" data-toggle="tooltip" data-placement="top" title="Drag And Drop a picture to represent your project">
			Drag And Drop Image Here<br><i class="fa fa-cloud-upload" style="font-size:20px;"></i><br> OR 
          <!-- <button type="button" class="btn btn-warning">-->	
            <input type="file" class="btn btn-warning" style="width:200px;" name="project_image1">
<!--			Upload Project Image
			</button>
-->		</div>
		<div style="margin:10px;background:#222;color:#fff;font-size:12px;padding:6px 12px;width:250px;">
			Now upload your project images below!
		</div>
		<div class="fileUpload">
			<span><i class="fa fa-plus">&nbsp;&nbsp;</i>Add Images</span>
		</div>
		<div style="clear:both;"></div>
        
		<div class="uploaded-area"></div>
		<div style="clear:both;"></div>
		<button style="margin:10px;" name="submitbut" type="submit" class="btn btn-success">
			Submit Project
		</button>
        </form>
	</div>
</div>

<!-- ---------------------Footer ------------------------------- -->
<?php include "include/footer.php";?>

</body>
</html>
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
$item2 = "Image";
$page_parent='designer_profile.php';
/*	$sql = "SELECT * from $tabl";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['id'] = $fetch['id'];
	*/
	
//////////////////////Select Project Images ///////////////////////////////////////////////////////////

 $sql2 = "SELECT * from $tab2 where images_id='".$id."' order by sort ASC";
 $exec2 = mysql_query($sql2) or die(mysql_error());
 
 
 

	if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='".$id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$image = $fetch['project_image'];
	$dvar['project_name'] = $fetch['project_name'];
	$dvar['project_image'] = $fetch['project_image'];
	$dvar['description'] = $fetch['description'];
	$dvar['id'] = $fetch['id'];
	
}
if(isset($_POST['submit'])){
	//print_r($_POST);
	$dvar['project_name'] = $_POST['project_name'];
	$dvar['description'] = $_POST['description1'];
	//$dvar['project_image'] = $_POST['project_image'];
	$image_names = $_POST['image_name'];
	$image_description = $_POST['description'];
	$image = $_POST['image'];
	//$dvar['id'] = $fetch['id'];
	$dvar['user_id'] = $user_uniq;
	if($dvar['project_name'] == ''){
		$flag[92] = 'r';
		}
		
			//print_r ($dvar);
	$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
	$file_field = 'project_image';
	$validate = validate_file($file_field, $allowed_ext, '0', '0');
	
	//print_r($validate);die;
	
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
		if($do == 'edit'){
			if($file == '1'){
			//echo "hi";die;
			$rand1 = random_generator(10);
			$image_name = $rand1.'.'.$ext;
			$path = "./img/".$image_name;
		}
		//echo $path;die;
		
		$sql_s = "select * from $tabl where uniq_id='$uniqc'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);

			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('./img/'.$fetch_s[$file_field]);
				$image_name = '';
				$sql_file = "$image_name";
			}
			if($file == '1'){
				unlink('./img/'.$fetch_s[$file_field]);
				$sql_file = "$image_name";
			}
			if($file == '1'){
				$add_dvar = array('project_image' => $sql_file);
			}
			
		  // $add_dvar = array('project_image' => $file_name);
			$remove_dvar = array('image_delete',);
//			$change_dvar = array('status' => '0');
			
			$sql_gal = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";
			$fg = 'ed';
		}
		
		//echo $_FILES[$file_field][name];die;
		if(mysql_query($sql_gal)){
			$flag[$fg] = $item;
			if($file == '1'){
				//echo "hi";die;
				 copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
    			  chmod("$path",0777);                 // set permission to the file.                // set permission to the file.
				 $thumb = './uploads/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				$max_width=270; // Fix the width of the thumb nail images
				$max_height=270; // Fix the height of the thumb nail imaage
				$extn = $ext;	$final = $thumb;	$res = '0';
				include("./include/image_resize.php");   // set permission to the file.
			}
			
			
			$time = time();
			foreach($image_names as $k=>$v){
				$sql_img="insert into project_images(sort,images_id,image_name,image,description,status,time) select max(sort)+1,'$id','".$v."','".$image[$k]."','".$image_description[$k]."','1','$time' from project_images";
				if(!mysql_query($sql_img)){ echo mysql_error();}	
				header("location:designer_profile.php");
			}
		}
		else{
			echo mysql_error();//$flag['q'] = 'r';
		}
	}
}

if($_GET['done']=='delete'){
	$id=$_GET['imgid'];
	$sql="select * from project_images where id='$id'";
	$exe=mysql_query($sql);
	/*$sql2="select * from project where id='$id'";
	$exe2=mysql_query($sql2);*/
	while($fetch_img=mysql_fetch_assoc($exe)){
		unlink('./uploads/'.$fetch_img['image']);
				}
				
	/*while($fetch_ppro=mysql_fetch_assoc($exe2)){
		unlink('img/'.$fetch_ppro['project_image']);
				}	*/		
		//delete from database
		 $sql_img_del="delete from project_images where id='".$id."'";
		 //$sql_pro_del="delete from project where id='".$id."'";
		
		if(/*mysql_query($sql_pro_del) &*/ mysql_query($sql_img_del)){
		$flag['d'] = $item2;
	}
	else{
		$flag['q'] = 'r';
	}
	}
	
			/*$file_name = $_FILES['image']['name'];
			if(move_uploaded_file($_FILES['image']['tmp_name'],'img/'.$_FILES['image']['name'])){
				$sql = "update user set image='".$file_name."' where uniq_id='$user_uniq'";
				$exe = mysql_query($sql);
				if(!$exe){ echo mysql_error();}
			}else{
			echo "Error Uploading file";die;	
			}
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
	<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<link rel="stylesheet" href="./css/custom.css">
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="./cssp/font-awesome.min.css">
<script src = "./js/jquery.js" type="text/javascript"></script>
<script src = "./js/jquery-ui.min.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script src = "./js/jquery.lazy.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/jquery.uploadfile.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="./css/uploadfile.css">
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/addproject.js"></script>
<?php    if($flag['d'] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $_SERVER['PHP_SELF'];?>?do=edit&id=<?php echo $_GET['id'];?>">
<?php } ?>

<?php    if($flag[$fg] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $page_parent;?>">
<?php } ?>
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
</head>

<style type="text/css">
	.uploaded-area{
		width: auto;
		text-align: center;
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
	.proj-img{
		border:1px solid #aaa;
		text-align: center;
		width: 290px;
		padding:20px;
		float: left;
		margin:30px;
	}
	.img{
		height: 170px;
		width: 250px;
		padding: 8px;
		border: 1px solid #aaa;
		box-shadow: 0 0 1px 1px #ccc;
	}
	.ajax-upload-dragdrop{
		margin-left: 140px;
	}
	a { color : white ; } 
	
	.footer-menu li a:hover{color:white; text-decoration:none;}
</style>

<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">
<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<?php include "./include/header.php" ?> 
		<!.........................HEADER ENDS ................................> 

<!-- ---------------------Main ------------------------------- -->
<div id="main" style="background:#fff;margin:20px;height:auto;width:95vw;opacity:1;padding:20px;text-align:center;">
	<h2 style="color:#C16700;">Edit Project</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?do=edit&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">

	<div style="margin:20px;padding:20px;margin-left:150px;n">
 			<?php echo print_messages($flag, $error_message, $success_message);?> 	
		<div style="float:left;">
			<img src="./img/<?php if(empty($dvar['project_image'])){ echo 'no_img.jpg'; }else{ echo $dvar['project_image'];}?>" height="200px" width="200px"><br><br>
            <input type="file" name="project_image" value="Upload Image" class="btn btn-warning"  style="width:200px;">
<!--			<button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Change previous image">Upload Image</button>
-->		</div>
		<div style="margin-left:20px;width:500px;float:left;text-align:left;font-size:14px;">
			Project Title<br>
			<input type="text" required class="form-control" name="project_name" value="<?php echo $dvar['project_name'];?>" placeholder="Previous Project Title Goes Here"  data-toggle="tooltip" data-placement="top" title="You can change title here"><br>
			Project Description<br>
			<textarea rows="3" required class="form-control"  name="description1" placeholder="Previous Description goes here" data-toggle="tooltip" data-placement="top" title="You can change description here"><?php echo $dvar['description'] ;?></textarea><br>
			<button type="submit" name="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;
			<a href="designer_profile.php" class="btn btn-primary">Back</a>
		</div>
	</div><div style="clear:both;"></div>
	<br><br><hr><br><br>
	<div style="margin-left:50px;">
		<div class="fileUpload">
			<span><i class="fa fa-plus">&nbsp;&nbsp;</i>Add More Images</span>
		</div>
		<div style="clear:both;"></div>
		<div class="uploaded-area"></div>
        <button type="submit" id="save_btn" name="submit" class="btn btn-primary pull-left"  style="margin-top:10px;">Save</button>

		<div style="clear:both;"></div>
		<div style="text-align:left;margin:20px;padding-left:30px;">
        <?php	while ($row_gory = mysql_fetch_assoc($exec2)){
			//print_r($row_gory);
			?>
			<div class="proj-img">	
				<div class="img"><img src="./img/<?php if(empty($row_gory['image'])){ echo 'no_img.jpg'; }else{ echo $row_gory['image'];}?>" height="100%" width="100%"><br></div>
				<span><?php echo $row_gory['image_name'];?></span><br>
				<span><?php echo $row_gory['description'];?></span><br>
				<a href="edit_img.php?do=edit&id=<?php echo $row_gory['id'];?>" class="btn btn-primary">Edit</a>
				<a href="<?php echo $_SERVER['PHP_SELF'];?>?do=edit&id=<?php echo $_GET['id'];?>&done=delete&imgid=<?php echo $row_gory['id'];?>" class="btn btn-primary">Delete</a>
			</div>
            <?php }?>
			
			
			
			
		</div>
	</div>
    </form>
</div>

<!-- ---------------------Footer ------------------------------- -->
<?php include "include/footer.php";?>
		
</body>
</html>
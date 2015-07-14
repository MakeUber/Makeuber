<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'project_images';
$item = 'Project Image';
$latest='latest';
$page_parent = 'manage_project_images.php';
$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['image_id'],"image_id" => $_GET['id']);

foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['id']);

$image_id = mysql_real_escape_string($_GET['image_id']);

$relation = mysql_real_escape_string($_GET['relation']);

if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='".$id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['image_name'] = $fetch['image_name'];
	$dvar['image'] = $fetch['image'];
	$dvar['description'] = $fetch['description'];

}

if($_POST['submitbut'] == 'Save'){
	$dvar['image_name'] = $_POST['image_name'];
	$dvar['description'] = $_POST['description'];

	if($dvar['image_name'] == ''){$flag[92] = 'r';}
	else if($dvar['description'] == ''){$flag[31] = 'r';}
		
	$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
	$file_field = 'image';
	
	if($_GET['do'] == 'edit'){
		$validate = validate_file($file_field, $allowed_ext, '0', '0');
	}
	else{
		$validate = validate_file($file_field, $allowed_ext, '0', '1');
	}
	
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
			$path = "../img/".$image_name;
			
		}
		
		if($_GET['do'] == 'edit'){
		
			$sql_s = "select * from $tabl where id='".$image_id."'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);

			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('../img/'.$fetch_s[$file_field]);
				
				$image_name = '';
				$sql_file = "$image_name";
				
			}
			if($file == '1'){
				unlink('../img/'.$fetch_s[$file_field]);
				
				$sql_file = "$image_name";
				
			}
			if($dvar['image_delete'] <> 1 && $file <> '1'){ 
				$sql_file = $fetch_s['image'];
				
			}if($file == '1'){
				//$add_dvar = array('image' => $sql_file);
				$dvar['image'] = $sql_file;
			}

			$add_dvar = array( 'time' => time(), 'image' => $sql_file,);
			$remove_dvar = array('image_delete');
			$change_dvar = array('status' => '0');
			
			$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$image_id."'";
			$fg = 'ed';
		}
		else{
			$uniq = random_generator(10);
			$add_dvar = array( 'images_id' => $id, 'status' => '1', 'time' => time(), 'image' => $image_name);
			$remove_dvar = array('image_delete');
			$change_dvar = array('status' => '1');

			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
			$sql = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl"; 
			$fg = 'ad';
		}
		if(mysql_query($sql)){
		//echo $path;die;
			if($file == '1'){
				copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
				chmod("$path",0777);                 // set permission to the file.
				 $thumb = '../img/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				//$max_width=800; // Fix the width of the thumb nail images
				//$max_height=500; // Fix the height of the thumb nail imaage
				///////////////////////////////////////////New height and width of the image //////////////////////////
				
				$new_width  = 250;
				$new_height = 200;
				$this_image = "../img/".$image_name;
				
				list($width, $height, $type, $attr) = getimagesize("$this_image");
				
				if ($width > $height) {
				$image_height = floor(($height/$width)*$new_width);
				$image_width  = $new_width;
				$image_height = $new_height;
				} else {
				$image_width  = floor(($width/$height)*$new_height);
				}		
				$max_width=$image_width; // Fix the width of the thumb nail images
				$max_height=$image_height; // Fix the height of the thumb nail imaage

				
				
				///////////////////////////////////////////////////////End of new height and width ///////////////////////////////
							$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");

			}
			$flag[$fg] = $item;
		}
		else{
			$flag['q'] = 'r';
			echo mysql_error();
		}
	}
}

if($_GET['do'] == 'edit' && ($flag[$fg] <> '')){
	$sql = "select * from $tabl where id='".$image_id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['name'] = $fetch['name'];
	$dvar['description'] = $fetch['description'];
	$dvar['image'] = $fetch['image'];
}
/////////////////////////multiple fildes update///////////////
if(isset($_POST['update'])){
$im_id =$_POST['id'];
$image_name =$_POST['image_name'];
$description =$_POST['description'];
$img=$_FILES['image']['name'];

foreach($im_id as $ki=>$v1){
$dvar['id']=$im_id[$ki];
$dvar['image_name']= $image_name[$ki];
$dvar['description']= $description[$ki];
$imgs = "SELECT * from $tabl where id='".$dvar['id']."'";
$edit_img=mysql_query($imgs);
$dvar_img=mysql_fetch_assoc($edit_img);
  
if($dvar_img['image']<>""){
	$path = "../img/".$image;
$image=$dvar_img['image'];
if($img[$ki]<>""){
	$rand1 = random_generator(10);
	$info = pathinfo($img[$ki]);
    $name = $info['filename'];
    $format = $info['extension'];                // set permission to the file.
	$img[$ki]=$name."_".$rand1.".".$format;
	$image=$img[$ki];
	$path = "../img/".$image;
	unlink('../img/'.$dvar_img['image']);
	}
}
else
{$rand1 = random_generator(10); 
  $info = pathinfo($img[$ki]);
	$name = $info['filename'];
    $format = $info['extension'];                // set permission to the file.
	$img[$ki]=$name."_".$rand1.".".$format;
	$image=$img[$ki];
$path = "../img/".$image;
unlink('../img/'.$dvar_img['image']);
}
if($dvar['image_name'] == ''){
		$flag[92] = 'r';
		}
    else if($dvar['description'] == ''){
		$flag[31] = 'r';
		}
		else if($image == ''){
		$flag[61] = 'r';
		}
		$add_dvar = array( 'time' => time(),'image' => $image);
		 $sql_gal = "UPDATE project_images SET ".update_query($dvar, $add_dvar)." where id='".$dvar['id']."'";
			$fg = 'ed';
		if(mysql_query($sql_gal)){
			
			if($img[$ki]<>""){
			
				copy($_FILES['image'][tmp_name][$ki], $path);     //  upload the file to the server
				chmod("$path",0777); 
				
				 $thumb = '../img/'.$image;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
			
				//$max_width=800; // Fix the width of the thumb nail images
				//$max_height=500; // Fix the height of the thumb nail imaage
				///////////////////////////////////////////New height and width of the image //////////////////////////
				$new_width  = 650;
				$new_height = 400;
				$this_image = "../img/".$image;
				
				list($width, $height, $type, $attr) = getimagesize($this_image);
				
				if ($width > $height) {
				$image_height = floor(($height/$width)*$new_width);
				$image_width  = $new_width;
				$image_height = $new_height;
				
				} else {
				$image_width  = floor(($width/$height)*$new_height);
				
				}		
				$max_width=$image_width; // Fix the width of the thumb nail images
				$max_height=$image_height; // Fix the height of the thumb nail imaage				///////////////////////////////////////////////////////End of new height and width ///////////////////////////////
				
				$extn = $ext;	$final = $thumb;	$res = '0';
				
				include("include/image_resize.php");}
			$flag[$fg] = $item;
		}
			else{
			$flag['q'] = 'r';
			echo mysql_error();
		}
		}
}
/////////////////////////multiple fildes update///////////////

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add/Edit <?php echo $item; ?></title>
<?php include("include/head.php"); ?>
<script type="text/javascript">
	var i;
	$(document).ready(function(){
		$('#tb_clone_click').click(function(){
			$("#table-data tr:first").clone().find("input").each(function() {
				$(this).val('').attr('id', function(_, id) { return id + i });
			}).end().appendTo("#table-data");
		var rowCount = document.getElementById('table-data').rows.length; 
		});
	});
	
</script>
<?php if(isset($_POST['update'])){
 if($flag[92] <> 'r' and $flag[31] <> 'r'){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $page_parent."?id=".$image_id;?>">
<?php } }?>
<?php if($_POST['submitbut'] == 'Save'){ ?>

<meta http-equiv="refresh" content="3; URL=<?php echo $page_parent."?id=".$id;?>">
<?php  }?>
</head>

<body>
<div align="center">
  <div class="container">
	<?php
    $pg_active['tut'] = 'active';
    require_once('include/header.php'); 
    ?>
    <div class="content">
      <div style="margin-top:10px">
      <?php
        echo print_messages($flag, $error_message, $success_message);
		?>
      </div>
      <div class="form5">
        <form id="add" name="add" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?1=1<?php echo $q_string; ?>" enctype="multipart/form-data">
            <table width="90%" border="0" cellpadding="5">
              <?php if($_GET['do'] == 'edit'){ ?>
             <tr>                
                  <td align="right" class="label_form">Image: </td>
                  <td>
                   <?php if(empty($dvar['image'])){
	echo "<img src='images/1.png' />";
	}else{
	      echo "<img src='../img/".$dvar['image']."' width='98px' height='98px'/>"; 
		  } ?><br />
                  <input name="image" type="file" class="input_file" value="<?php echo $dvar['image'];?>"/><br class="clear" /></td>
              </tr>
               <tr>                
                  <td align="right" class="label_form">Name: </td>
                  <td><input name="image_name" type="text" class="input_text" value="<?php echo $dvar['image_name'];?>"/><br class="clear" /></td>
              </tr>
               <tr>
              <td align="right" class="label_form" valign="top">Description: </td>
              <td><textarea style="width:245px; height:100px; border-radius:5px; border-style:solid; border-width:1px; border-color:#CCC" id="description" name="description" ><?php echo $dvar['description'];?></textarea>
              </td>
            </tr> 
            
                        
           <tr>
                <td>&nbsp;</td>
                <td>
            
                    <div class="btn">
                        <input class="button" name="submitbut" value="Save" type="submit" />
                        <a class="a_button" href="<?php echo $page_parent."?1=1".$q_string; ?>">Cancel</a>
                    </div>
                </td>
              </tr>
              <?php }?>
              <?php if($_GET['do'] <> 'edit'){ ?>
              <tr>  <td>&nbsp;</td>
              <td>
              <div id="mulitplefileuploader">Add Images</div>
              <div id="status"></div>
              </td>
              
              <script>
$(document).ready(function()
{
var settings = {
	url: "upload3.php?id=<?php echo $image_id;?>",
	method: "POST",
	allowedTypes:"jpg,png,gif,doc,pdf,zip",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(files,data,xhr)
	{
		$("#status").html("<font color='green'><b>Please wait, Click on Done when all images are uploaded</b></font> &nbsp; <a class='a_button' href='add_edit_project_images.php?image_id=<?php echo $image_id;?>'>Done</a>");
	},
	onError: function(files,status,errMsg)
	{		
		$("#status").html("<font color='red'>Upload is Failed</font>");
		
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
</script>
            </tr>
            <?php }?>
            </table>
     <?php if($_GET['do'] <> 'edit'){ ?>     </form>
        
<form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?1=1&image_id=<?php echo $image_id;?>" enctype="multipart/form-data">
           <ul class="project_ul">
           <?php $img = "SELECT * from $tabl where images_id='".$image_id."' order by id ASC";
		   $edit_img=mysql_query($img);
		   while($dvar=mysql_fetch_assoc($edit_img)){
		   ?>
           <li>
         <?php if(empty($dvar['image'])){
	echo "<img src='images/1.png' width='150px' height='150px'/>";
	}else{
	      echo "<img src='../img/".$dvar['image']."' width='150px' height='150px'/>"; 
		  } ?><br />
                  <input name="image[]" type="file" class="input_file" value="<?php echo $dvar['image'];?>"/>
                  <br class="clear" />
         <br class="clear" />
         <?php
         //////////////////////////////////// Manage Design Section ////////////////////////////////////////
$sql_category = "select * from category where status='1'";
$exec_category = mysql_query($sql_category);
?>
                   <select class="input_file" style="width:245px; height:40px; border-radius:5px; border-style:solid; border-width:1px; border-color:#CCC"  name="image_name">
            <option value="">Select Tag</option>
                <?php 
				while($fetch_category = mysql_fetch_assoc($exec_category)){
				?>
                <option value="<?php echo $fetch_category['category_name'];?>" <?php 
				if (strpos($fetch_category['category_name'],$dvar['image_']) !== false) { echo "selected='selected'";}
				?>><?php echo $fetch_category['category_name'];?></option>
                <?php }?>
                </select>
                  <br class="clear" />
         <br class="clear" />
           <input name="image_name[]" type="text" class="input_text" value="<?php echo $dvar['image_name'];?>"/><br class="clear" />
           <textarea style="width:245px; height:100px; border-radius:5px; border-style:solid; border-width:1px; border-color:#CCC" name="description[]" id="description" ><?php echo $dvar['description'];?></textarea><br class="clear" />
            <input type="hidden" name="id[]"  value="<?php echo $dvar['id'];?>"/>
          
           </li>
           <?php }?>
           </ul>
            <input class="button" name="update" value="Update" type="submit" />
        </form>  
      <?php
	 }
	  ?>  
      </div>
      <?php
	  	 include "include/footerlogo.php";
	  ?>
    </div>
    <div class="clear"></div>
  </div>
</div>

</body>
</html>
<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'cust_images';
$item = 'Image';
$page_parent = 'manage_cust_images.php';
$query_string = array("search" => $_GET['search'], 'cust_img'=>$_GET['cust_img'],  "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['id']);
$cust_img = mysql_real_escape_string($_GET['cust_img']);


if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='".$id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$image = $fetch['image'];
}

if($_POST['submitbut'] == 'Save'){
		$dvar['image_delete'] = $_POST['image_delete'];
	$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
	$file_field = 'image';
	if($_GET['do'] == 'edit'){
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
			$path = "../pics/".$image_name;
			
		}
		if($_GET['do'] == 'edit'){
			$sql_s = "select * from $tabl where id='".$id."'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);

			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('../pics/'.$fetch_s[$file_field]);
				
				$image_name = '';
				$sql_file = "$image_name";
				
			}
			if($file == '1'){
				unlink('../pics/'.$fetch_s[$file_field]);
				
				$sql_file = "$image_name";
				
			}
			if($dvar['image_delete'] <> 1 && $file <> '1'){ 
				$sql_file = $fetch_s['image'];
				
			}
			
			$add_dvar = array('image' => $sql_file, 'cust_id'=>$cust_img, 'time' => time());
			$remove_dvar = array('image_delete',);
//			$change_dvar = array('status' => '0');
			
			$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";

			$fg = 'ed';
		}
		else{
			$uniq = random_generator(10);
			$add_dvar = array('image' => $image_name, 'uniq' => $uniq, 'cust_id'=>$cust_img, 'status' => '1', 'time' => time());
			$remove_dvar = array('image_delete','image_delete2');
//			$change_dvar = array('status' => '1');

			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
			$sql = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
			
			$fg = 'ad';
			
		}
		if(mysql_query($sql)){
			if($file == '1'){
				copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
				chmod("$path",0777);                 // set permission to the file.
				 $thumb = '../pics/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				//$max_width=800; // Fix the width of the thumb nail images
				//$max_height=500; // Fix the height of the thumb nail imaage
				///////////////////////////////////////////New height and width of the image //////////////////////////
				
				$new_width  = 250;
				$new_height = 200;
				$this_image = "../pics/".$image_name;
				
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
			echo mysql_error();//$flag['q'] = 'r';
		}
	}
}

if($_GET['do'] == 'edit' && ($flag[$fg] <> '')){
	$sql = "SELECT * from $tabl where id='$id'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['name'] = $fetch['name'];
	$image = $fetch['image'];
	$image2 = $fetch['image2'];
}

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
<?php
if($flag[$fg] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $page_parent."?1=1".$q_string; ?>">
<?php } ?>
</head>

<body>
<div align="center">
  <div class="container">
	<?php
    $pg_active['con'] = 'active';
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
            <table width="1150" border="0" cellpadding="5">
          
              <tr>                
                  <td align="right" class="label_form">Image: </td>
                  <td><div class="pic">
                       <img src="<?php if($image <> ''){echo '../pics/'.$image;}else{echo 'images/1.png';} ?>" alt="images/1" width="98" height="98" /><br />
                       <?php 
                       /*  if($_GET['do'] == 'edit'){
                       ?>
                         <input name="image_delete" value="1" type="checkbox" /> <span class="edit">Delete Image</span>
                      <?php
                          }*/
                      ?>
                      </div>
                      <div class="edit1"><input name="image" type="file" /><div class="clear"></div>
                        <span class="edit">
                          (Resolution: 150px X 100px)<br />
                          (Format Supported: GIF, PNG, JPG)
                          <br /><span style="color:green;">(Left Image)</span>
                        </span>
                      </div>
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
            </table>
        </form>
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

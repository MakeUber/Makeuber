<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'project';
$item = 'Project';
$page_parent = 'manage_projects.php';
$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['id']);
$relation = mysql_real_escape_string($_GET['relation']);


if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='".$id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['project_name'] = $fetch['project_name'];
	$dvar['project_image'] = $fetch['project_image'];
	$dvar['floor_plan'] = $fetch['floor_plan'];
	$dvar['description'] = $fetch['description'];
     $dvar['apartment'] = $fetch['apartment'];
     $dvar['city'] = $fetch['city'];
     $dvar['area'] = $fetch['area'];
	  $dvar['price'] = $fetch['price'];

}

if($_POST['submitbut'] == 'Save'){
	$dvar['project_name'] = $_POST['project_name'];
	$dvar['description'] = $_POST['description'];
     $dvar['apartment'] = $_POST['apartment'];
     $dvar['city'] = $_POST['city'];
     $dvar['area'] = $_POST['area'];
$dvar['price'] = $_POST['price'];
	if($dvar['project_name'] == ''){$flag[1] = 'r';}
		
	$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
	$file_field = 'project_image';
	$file_field1 = 'floor_plan';
	
	if($_GET['do'] == 'edit'){
		$validate = validate_file($file_field, $allowed_ext, '0', '0');
		$validate1 = validate_file($file_field1, $allowed_ext1, '0', '0');
	}
	else{
		$validate = validate_file($file_field, $allowed_ext, '0', '1');
		$validate1 = validate_file($file_field1, $allowed_ext1, '0', '1');
	}
	
	if($validate[0] <> '1'){
		$flag['file'] = $validate[0];
	}
	else if($validate[1] <> ''){
		$file = '1';
		$ext = $validate[2];
	}
	if($validate1[0] <> '1'){
		$flag['file'] = $validate1[0];
	}
	else if($validate1[1] <> ''){
		$file1 = '1';
		$ext1 = $validate1[2];
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
		if($file1 == '1'){
			$rand2 = random_generator(10);
			$image_name1 = $rand2.'.'.$ext1;
			$path1 = "../img/".$image_name1;
			
		}
			
		
		if($_GET['do'] == 'edit'){
			$sql_s = "select * from $tabl where id='".$id."'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);

			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('../img/'.$fetch_s[$file_field]);
				
				$image_name = '';
				$sql_file = "$image_name";
				
			}
			if($dvar['image_delete'] == 1 && $file1 <> '1'){
				unlink('../img/'.$fetch_s1[$file_field1]);
				
				$image_name1 = '';
				$sql_file1 = "$image_name";
				
			}
			if($file == '1'){
				unlink('../img/'.$fetch_s[$file_field]);
				
				$sql_file = "$image_name";
				
			}
			if($file1 == '1'){
				unlink('../img/'.$fetch_s1[$file_field1]);
				
				$sql_file1 = "$image_name";
				
			}
			if($dvar['image_delete'] <> 1 && $file <> '1'){ 
				$sql_file = $fetch_s['project_image'];
				
			}
			if($dvar['image_delete1'] <> 1 && $file1 <> '1'){ 
				$sql_file1 = $fetch_s1['floor_plan'];
				
			}
			if($file == '1'){
				//$add_dvar = array('image' => $sql_file);
				$dvar['project_image'] = $sql_file;
			}
			if($file1 == '1'){
				//$add_dvar = array('image' => $sql_file);
				$dvar['floor_plan'] = $sql_file1;
			}

			$add_dvar = array( 'time' => time());
			$remove_dvar = array('image_delete', 'image_delete1');
			$change_dvar = array('status' => '0');
			
			$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";
			$fg = 'ed';
		}
		else{
			$uniq = random_generator(10);
			$add_dvar = array( 'id' => $id, 'status' => '1', 'time' => time(), 'project_image' => $image_name, 'floor_plan' => $image_name1);
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
				
				//$max_width=200; // Fix the width of the thumb nail images
				//$max_height=174; // Fix the height of the thumb nail imaage
			
				// $extn $path $final required
				//$extn = $ext;	$final = $thumb;	$res = '0';
				//include("include/image_resize.php");

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
	$sql = "SELECT * from $tabl where id='$id'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['name'] = $fetch['name'];
	$dvar['price'] = $fetch['price'];
	$dvar['description'] = $fetch['description'];
	$dvar['quantity'] = $fetch['quantity'];
	$image = $fetch['category_image'];
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
            <table width="1150" border="0" cellpadding="5">
             <tr>                
                  <td align="right" class="label_form">Image: </td>
                  <td>
                   <?php if(empty($dvar['project_image'])){
	echo "<img src='images/1.png' />";
	}else{
	      echo "<img src='../img/".$dvar['project_image']."' width='98px' height='98px'/>"; 
		  } ?><br />
                  <input name="project_image" type="file" class="input_file" value="<?php echo $dvar['project_image'];?>"/><br class="clear" /></td>
              </tr>
              <tr>                
                  <td align="right" class="label_form">Floor Plan: </td>
                  <td>
                   <?php if(empty($dvar['floor_plan'])){
	echo "<img src='images/1.png' />";
	}else{
	      echo "<img src='../img/".$dvar['floor_plan']."' width='98px' height='98px'/>"; 
		  } ?><br />
                  <input name="project_image" type="file" class="input_file" value="<?php echo $dvar['project_image'];?>"/><br class="clear" /></td>
              </tr>
               <tr>                
                  <td align="right" class="label_form">Name: </td>
                  <td><input name="project_name" type="text" class="input_text" value="<?php echo $dvar['project_name'];?>"/><br class="clear" /></td>
              </tr>
              <tr>                
                  <td align="right" class="label_form">City: </td>
                  <td><input name="city" type="text" class="input_text" value="<?php echo $dvar['city'];?>"/><br class="clear" /></td>
              </tr>
              <tr>                
                  <td align="right" class="label_form">Area: </td>
                  <td><input name="area" type="text" class="input_text" value="<?php echo $dvar['area'];?>"/><br class="clear" /></td>
              </tr>
              <tr>                
                  <td align="right" class="label_form">Price: </td>
                  <td><input name="price" type="text" class="input_text" value="<?php echo $dvar['price'];?>"/><br class="clear" /></td>
              </tr>
              <tr>                
                  <td align="right" class="label_form">Description: </td>
                  <td><textarea name="description" type="text" class="input_text" ><?php echo $dvar['description'];?></textarea><br class="clear" /></td>
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
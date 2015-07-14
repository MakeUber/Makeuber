<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'membership_type';
$item = 'Membership';
$page_parent = 'manage_membership.php';
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
	$dvar['type'] = $fetch['type'];
	$dvar['budget'] = $fetch['budget'];
	$dvar['records'] = $fetch['records'];
	$dvar['days'] = $fetch['days'];
	$dvar['image'] = $fetch['image'];
    $dvar['description'] = $fetch['description'];
}

if($_POST['submitbut'] == 'Save'){
	$dvar['budget'] = $_POST['budget'];
	$dvar['records'] = $_POST['records'];
	$dvar['days'] = $_POST['days'];
	$dvar['description'] = $_POST['description'];

	 if($dvar['budget'] == '' || !(ctype_digit($dvar['budget']))){$flag[18] = 'r';}
	else if($dvar['records'] == '' || !(ctype_digit($dvar['records']))){$flag[10] = 'r';}
	else if($dvar['days'] == '' || !(ctype_digit($dvar['days']))){$flag[19] = 'r';}
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
			$sql_s = "select * from $tabl where id='".$id."'";
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

			$add_dvar = array( 'time' => time());
			$remove_dvar = array('image_delete');
			$change_dvar = array('status' => '0');
			
			$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";
			$fg = 'ed';
		}
		else{
			$uniq = random_generator(10);
			$add_dvar = array( 'id' => $id, 'status' => '1', 'time' => time(), 'image' => $image_name);
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
	$dvar['type'] = $fetch['type'];
	$dvar['budget'] = $fetch['budget'];
	$dvar['records'] = $fetch['records'];
	$dvar['days'] = $fetch['days'];
	$dvar['discription'] = $fetch['discription'];
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
    $pg_active['member'] = 'active';
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
            <table width="900" border="0" cellpadding="5">
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
                  <td align="right" class="label_form">Type: </td>
                  <td><input name="type" disabled="disabled" type="text" class="input_text" value="<?php echo $dvar['type'];?>"/><br class="clear" /></td>
              </tr>
              <tr>                
                  <td align="right" class="label_form">Budget: </td>
                  <td><input name="budget" type="text" class="input_text" value="<?php echo $dvar['budget'];?>"/><br class="clear" /></td>
              </tr>
              <tr>                
                  <td align="right" class="label_form">Records To Show: </td>
                  <td><input name="records" type="text" class="input_text" value="<?php echo $dvar['records'];?>"/><br class="clear" /></td>
              </tr>
              <tr>                
                  <td align="right" class="label_form">Membership Days: </td>
                  <td><input name="days" type="text" class="input_text" value="<?php echo $dvar['days'];?>"/><br class="clear" /></td>
              </tr>
           <tr>
           <tr>
              <td align="right" class="label_form" valign="top">Description: </td>
              <td><textarea name="description" style="width:350px; height:100px; border-radius:5px; border-style:solid; border-width:1px; border-color:#CCC"><?php echo $dvar['description'];?></textarea></td>
            </tr>
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
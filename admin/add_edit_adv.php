<?php
include "../init.php";// include init
include "../config_db.php";// database connection details stored here
include "include/protecteed.php";// page protect function here

$tabl = 'adv';
$item = 'Adv';
$page_parent = 'add_edit_adv.php';
$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['id']);
$relation = mysql_real_escape_string($_GET['relation']);


if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='24'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$image = $fetch['image'];
	$dvar['name'] = 'Advertisement';
	$dvar['widget1'] = $fetch['widget1'];
	$dvar['widget2'] = $fetch['widget2'];
	$dvar['widget3'] = $fetch['widget3'];
	$dvar['widget4'] = $fetch['widget4'];
	$dvar['widget5'] = $fetch['widget5'];
	$dvar['widget6'] = $fetch['widget6'];
	$dvar['status'] = $fetch['status'];
		//print_r($dvar);
}

if($_POST['submitbut'] == 'Save'){
	$dvar['name'] = 'Advertisement';
	$dvar['widget1'] = $_POST['widget1'];
	$dvar['widget2'] = $_POST['widget2'];
	$dvar['widget3'] = $_POST['widget3'];
	$dvar['widget4'] = $_POST['widget4'];
	$dvar['widget5'] = $_POST['widget5'];
	$dvar['widget6'] = $_POST['widget6'];
	$dvar['status'] =  $_POST['status'];
	
  	//print_r($dvar);
	if($dvar['name'] == ''){$flag[4] = 'r';}
	//else if ($start-$end > 0){$flag[140] = 'r';}
	/*else if($dvar['widget1'] == ''){$flag[137] = 'r';}
	else if($dvar['widget2'] == ''){$flag[137] = 'r';}
	else if($dvar['widget3'] == ''){$flag[137] = 'r';}
	else if($dvar['widget4'] == ''){$flag[137] = 'r';}
	else if($dvar['widget5'] == ''){$flag[137] = 'r';}
	else if($dvar['widget6'] == ''){$flag[137] = 'r';}*/
	//else if($dvar['link'] == ''){$flag[136] = 'r';}
	//elseif(($dvar['start_date'] == '') && ($_GET['do'] != 'edit')){$flag[127] = 'r';}
	//else if($dvar['end_date'] == ''){$flag[128] = 'r';}
	
	if(!empty($flag)){
		$flag_r = 'r';
	}
	else{
		if($_GET['do'] == 'edit'){
			$add_dvar = array('time' => time());
			$remove_dvar = array('start_date');
//			$change_dvar = array('status' => '0');			
			
			$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='24'";
			
			$fg = 'ed';
						
		}
		else{
			$uniq = random_generator(10);
			$add_dvar = array('uniq' => $uniq, 'status' => '1', 'time' => time());
			
//			$change_dvar = array('status' => '1');

			echo list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
		    $sql = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
			$fg = 'ad';
		}
		if(mysql_query($sql))
		{
			$flag[$fg] = $item;
		}
		else{
			die(mysql_error());
			$flag['q'] = 'r';
		}
	}
}

if($_GET['do'] == 'edit' && ($flag[$fg] <> '')){
	$sql = "SELECT * from $tabl where id='24'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$image = $fetch['image'];
	$dvar['name'] = $fetch['name'];
	$dvar['widget1'] = $fetch['widget1'];
	$dvar['widget2'] = $fetch['widget2'];
	$dvar['widget3'] = $fetch['widget3'];
	$dvar['widget4'] = $fetch['widget4'];
	$dvar['widget5'] = $fetch['widget5'];
	$dvar['widget6'] = $fetch['widget6'];
	$dvar['status'] = $fetch['status'];
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add/Edit <?php echo $item; ?></title>
<?php include("include/head.php"); ?>

<?php
if($flag[$fg] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $page_parent."?1=1".$q_string; ?>">
<?php } ?>


</head>

<body onload="doOnLoad();">
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
                <td align="right" class="label_form">Name: </td>
                <td><input name="name" class="input_text" type="text" value="Advertisement" disabled="disabled" /><br class="clear" /></td>
              </tr>
              <tr>                
                    <td valign="top" align="right" class="label_form">News Widget(Tutorial Page) : </td>
                    <td  class="txt1input"  ><textarea name="widget1" style="height:100px; width:500px; margin-top:0px;"><?php echo $dvar['widget1'];?></textarea>
                    </td>
              </tr>
               <tr>                
                    <td valign="top" align="right" class="label_form">News Widget(Most Viewed Page) : </td>
                    <td  class="txt1input"  ><textarea name="widget2" style="height:100px; width:500px; margin-top:0px;"><?php echo $dvar['widget2'];?></textarea>
                    </td>
              </tr>
               <tr>                
                    <td valign="top" align="right" class="label_form">News Widget1(Tutorial Detail Page) : </td>
                    <td  class="txt1input"  ><textarea name="widget3" style="height:100px; width:500px; margin-top:0px;"><?php echo $dvar['widget3'];?></textarea>
                    </td>
              </tr>
              
              <tr>                
                    <td valign="top" align="right" class="label_form">News Widget2(Tutorial Detail Page) : </td>
                    <td  class="txt1input"  ><textarea name="widget4" style="height:100px; width:500px; margin-top:0px;"><?php echo $dvar['widget4'];?></textarea>
                    </td>
              </tr>
              <tr>                
                    <td valign="top" align="right" class="label_form">News Widget3(Tutorial Detail Page) : </td>
                    <td  class="txt1input"  ><textarea name="widget5" style="height:100px; width:500px; margin-top:0px;"><?php echo $dvar['widget5'];?></textarea>
                    </td>
              </tr>
              <tr>                
                    <td valign="top" align="right" class="label_form">News Widget4(Tutorial Detail Page) : </td>
                    <td  class="txt1input"  ><textarea name="widget6" style="height:100px; width:500px; margin-top:0px;"><?php echo $dvar['widget6'];?></textarea>
                    </td>
              </tr>
              <!-- <tr>                
                    <td valign="top" align="right" class="label_form">Status: </td>
                  
                    <td  class="txt1input"><span style="color:#090">Active</span><input type="radio" name="status" value="1" <?php //if($dvar['status'] == '1'){echo "checked = 'checked'";}?>  checked="checked"/><span style="color:#f00"> Inactive</span> <input type="radio" name="status" value="0" <?php if($dvar['status'] == '0'){echo "checked = 'checked'";}?> />
                    </td>
              </tr>-->
             <tr>
                <td>&nbsp;</td>
                <td>
                    <div class="btn">
                        <input class="button" name="submitbut" value="Save" type="submit" />
                        <a class="a_button" href="add_edit_<?php echo strtolower($item); ?>.php?do=edit">Cancel</a>
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

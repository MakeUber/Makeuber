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

$sql = "SELECT * from $tabl where id='".$id."'";
$exec = mysql_query($sql) or die(mysql_error());
$fetch = mysql_fetch_assoc($exec);
$dvar['membership'] = $fetch['membership'];
$dvar['type'] = $fetch['type'];
$dvar['budget'] = $fetch['budget'];
$dvar['records'] = $fetch['records'];
$dvar['days'] = $fetch['days'];
$dvar['image'] = $fetch['image'];
$dvar['description'] = $fetch['description'];
$dvar['status'] = $fetch['status'];
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View <?php echo $item; ?></title>
<?php include("include/head.php"); ?>
<script type="text/javascript">
jQuery(document).ready(function () {
	$('input#start_date').simpleDatepicker({ startdate: 2012, enddate: 2099 });
	$('input#end_date').simpleDatepicker({ startdate: 2012, enddate: 2099 });
});
</script>
</head>
<body>
<div align="center">
  <div class="container">
	<?php
    $pg_active['member'] = 'active';
    require_once('include/header.php'); 
    ?>
    <div class="content">
      <div class="viewform">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <table width="1150" border="0" cellpadding="5">
      <tr>
            <td align="right" class="label_form"><div class="view1">Project image :</div></td>
         	<td><div class="view2"><img src="../img/<?php echo $dvar['image']; ?>" height="200px" width="200px" /></div></td>
         </tr>
          <tr>
            <td align="right" class="label_form"><div class="view1">Membership Type :</div></td>
         	<td><div class="view2"><?php echo $dvar['type']; ?></div></td>
         </tr>
        <tr>
            <td align="right" class="label_form"><div class="view1">Budget :</div></td>
         	<td><div class="view2"><?php echo $dvar['budget']; ?></div></td>
         </tr>
         <tr>
            <td align="right" class="label_form"><div class="view1">Records To Show :</div></td>
         	<td><div class="view2"><?php echo $dvar['records']; ?></div></td>
         </tr>
         <tr>
            <td align="right" class="label_form"><div class="view1">Days :</div></td>
         	<td><div class="view2"><?php echo $dvar['days']; ?> Days</div></td>
         </tr>
         <tr>
            <td align="right" class="label_form"><div class="view1">Description :</div></td>
         	<td><div class="view2"><?php echo $dvar['description']; ?></div></td>
         </tr>
       <tr>
              <td align="right" class="label_form"><div class="view1">Category Status :</div></td>
              <td><div class="view2">
                  <?php 
				if($dvar['status'] == 1){echo '<span style="color:#009900">Active</span>';} 
				else if($dvar['status'] == 0){ echo '<span style="color:#ff0000">Inactive</span>';} 
				else if($dvar['status'] == 2){ echo '<span style="color:#990000">Banned</span>';}
			 ?>
                </div></td>
            </tr>
         <tr><td></td>
            <td><a class="a_button" href="<?php echo $page_parent."?1=1".$q_string; ?>">Close</a></td>
         </tr>
     
       </table>
        </form>
      </div>
      <?php
	   include "include/footerlogo.php";
	  ?>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
</body>
</html>

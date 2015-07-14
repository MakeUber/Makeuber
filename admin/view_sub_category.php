<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'sub_categories';
$item = 'sub Category';
$page_parent = 'manage_sub_categories.php';
$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['id']);

$sql = "SELECT * from $tabl where id='".$id."'";
$exec = mysql_query($sql) or die(mysql_error());
$fetch = mysql_fetch_assoc($exec);
$dvar['name'] = $fetch['name'];
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
    $pg_active['ctg'] = 'active';
    require_once('include/header.php'); 
    ?>
    <div class="content">
      <div class="viewform">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <table width="1150" border="0" cellpadding="5">
      
          <tr>
            <td align="right" class="label_form"><div class="view1">Category Name :</div></td>
         	<td><div class="view2"><?php echo $dvar['name']; ?></div></td>
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

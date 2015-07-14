<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'tutorial';
$item = 'Tutorial';
$page_parent = 'manage_tutorial.php';
$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['id']);

$sql = "SELECT $tabl.*, users.first_name, users.last_name,categories.name as cname from $tabl left outer join users on users.uniq = $tabl.user_uniq left outer join categories on categories.id = $tabl.relation where $tabl.id='".$id."'";
$exec = mysql_query($sql) or die(mysql_error());
$fetch = mysql_fetch_assoc($exec);
$dvar['title'] = $fetch['title'];
$dvar['uniq'] = $fetch['uniq'];
$dvar['description'] = $fetch['description'];

// for  images

$sql_img = "select * from files where relation='".$dvar['uniq']."' order by id ASC";
$exec_img = mysql_query($sql_img);

//for tool
$sql_tool = "select * from tools where relation='".$dvar['uniq']."' order by id ASC";
$exec_tool = mysql_query($sql_tool);
		
 
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
    $pg_active['tut'] = 'active';
    require_once('include/header.php'); 
    ?>
    <div class="content">
      <div class="viewform">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <table width="1150" border="0" cellpadding="5">
      
          <tr>
            <td align="right" class="label_form"><div class="view1">Tutorial :</div></td>
         	<td><div class="view2"><?php echo $dvar['title']; ?></div></td>
         </tr>
          <tr>
            <td align="right" class="label_form"><div class="view1">Category :</div></td>
         	<td><div class="view2"><?php echo $fetch['cname']; ?></div></td>
         </tr>
       <tr>
            <td align="right" class="label_form"><div class="view1">Tutorial Image:</div></td>
         	<td><div class="view2"><img src="<?php if($fetch['image'] <> ''){echo '../pics/'.$fetch['image'];}else{echo 'images/1.png';} ?>" alt="images/1" width="98" height="98" /></div></td>
         </tr>
         
          <?php $i=1;while($fetch_img = mysql_fetch_assoc($exec_img)){ ?>
         <tr>
         	<td align="right" class="label_form"><div class="view1">Image <?php echo $i;?>:</div></td>
            <td><div class="pic"><img src="<?php if($fetch_img['location'] <> ''){echo '../'.$fetch_img['location'];}else{echo 'images/1.png';} ?>" alt="images/1" width="98" height="98" /></div></td>
         </tr>
         <tr>
         	<td align="right" class="label_form"><div class="view1">Description <?php echo $i;?> :</div></td>
            <td><div class="view2" style="width:620px;"><?php echo nl2br($fetch_img['description']); ?></div></td>
         </tr>
        
         
         <?php $i++;} ?>
         
         <?php $j=1;while($fetch_tool = mysql_fetch_assoc($exec_tool)){ ?>
          <tr>
         	<td align="right" class="label_form"><div class="view1">Tool Used <?php echo $j;?> :</div></td>
            <td><div class="view2" style="width:620px;"><?php echo $fetch_tool['tool']; ?></div></td>
          </tr>
         
         <?php $j++ ;} ?>
          <tr>
         	<td align="right" class="label_form"><div class="view1">Posted By :</div></td>
            <td><div class="view2" style="width:620px;"><?php echo $fetch['first_name']. " ".$fetch['last_name']; ?></div></td>
         </tr>
          <tr>
         	<td align="right" class="label_form"><div class="view1">Posted Date :</div></td>
            <td><div class="view2" style="width:620px;"><?php echo date("M-d-Y g:i:s A", $fetch['time']); ?></div></td>
         </tr>
         
         <tr>
         	<td align="right" class="label_form"><div class="view1">Current Time :</div></td>
            <td><div class="view2" style="width:620px;"><?php echo date("M-d-Y g:i:s A"); ?></div></td>
         </tr>
         
         <tr><td></td>
            <td><a class="a_button" href="<?php echo $page_parent."?5=5".$q_string; ?>">Close</a></td>
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

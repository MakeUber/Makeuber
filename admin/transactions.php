<?php
include "../init.php";// database connection details stored here
include "../config_db.php";// database connection details stored here
include "include/protecteed.php";// page protect function here
$tabl = 'place_order';

// Config. for pagination //
$page = $_GET['page'];				// get variable for page
$perpage = '10';						// Show per page
$base_tabl = $tabl;				// table name for query
$item = 'Transactions';				// table name for query
$namep = "transactions.php";					// Page name
//Get stcom value
$stcom = stcom($page, $perpage);

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];

if($date_from <> '' && $date_to <> ''){
	$time_frame = 'set';
	$name = $_GET['user'];
	$date_from_arr = explode('-', $date_from);
	$date_from_ts = mktime(0, 0, 0, $date_from_arr[1], $date_from_arr[2], $date_from_arr[0]);
	$date_to_arr = explode('-', $date_to);
	$date_to_ts = mktime(23, 59, 59, $date_to_arr[1], $date_to_arr[2], $date_to_arr[0]);
	
	// Select Query part for every query related to this page
	if($name == 'guest'){
		$sql_rest = $name <> '' ? " AND $base_tabl.user_uniq='' " : '';
	}
	else{
	$sql_rest = $name <> '' ? " AND users.first_name='$name' " : '';
	}
	$select = "$base_tabl.*, users.first_name,users.last_name,$base_tabl.id as bid ";
	$from = "  $base_tabl left outer join users on users.uniq_id=$base_tabl.user_uniq where $base_tabl.status <> '0' AND $base_tabl.time > '$date_from_ts' AND $base_tabl.time < '$date_to_ts' $sql_rest";
	
	if($_GET['search'] == '' || $_GET['search'] == 'search'){
		// Make query to select records
		$sql1 = "SELECT $select from $from left outer join users on users.uniq_id=$base_tabl.user_uniq";		// SQL query to select rows.
	}
	else{
		$search_txt = $_GET['search'];
		$search_txt_db = mysql_real_escape_string($search_txt);
		$search_q = " AND (users.first_name like '%$search_txt_db%' OR users.last_name like '%$search_txt_db%' OR $base_tabl.id like '%$search_txt_db%')"; 
	}
	$sql1 = "SELECT $select from $from ".$search_q;
	// If multiple rows selected and form submitted
	
	if($_POST['Delete'] == 'Delete Selected'){
		@$chk = $_POST['chk'];
		$i='0';
		if( is_array($chk)){
			while (list ($key, $val) = each ($chk)) {
				if($val <> ''){
					$chk_arr[$i] = $val;
				}
				$i++;
			}
		}
		$arr_num = count($chk_arr);
		if($arr_num > 0){
			$sql_s = "SELECT image from $base_tabl where id in (";
			$sql = "DELETE from $base_tabl where id in (";
			$j = 0;
			while($j<$arr_num){
				if($j<>0){$sql_sub = $sql_sub.",";}
				$sql_sub = $sql_sub."$chk_arr[$j]";
				$j++;
			}
			$sql = $sql.$sql_sub.')';
			$sql_s = $sql_s.$sql_sub.')';
			//delete images/files
			$exec_s = mysql_query($sql_s);
			while($fetch_s = mysql_fetch_assoc($exec_s)){
				unlink('../pics/'.$fetch_s[image]);
				unlink('../thumb/'.$fetch_s[image]);
			}
			if(mysql_query($sql) or die(mysql_error())){$flagp = 'green';}
			else{$flag_q = 'r';}
		}
		else{$flag_r = 'r';}
	}
	
	//If Delete button is pressed for one row
	
	if($_GET['do'] == 'delete' && ctype_digit($_GET['id'])){
		$id = $_GET['id'];
		$sql = "SELECT image from $base_tabl where id='$id'";
		$exec = mysql_query($sql);
		list($image) = mysql_fetch_row($exec);
		
		unlink('../pics/'.$image);
		unlink('../thumb/'.$image);
		
		$sql = "DELETE from $base_tabl where id='$id'"; 
		if(mysql_query($sql)){
			$flagg = 'g';
		}
		else{
			die(mysql_error());
		}
	}
	
	
	if($_GET['do'] == 'enable'){
		$id = $_GET['id'];
		$sql = "UPDATE $tabl SET status='1' where id = '$id'";
		mysql_query($sql) or die(mysql_error());
	}
	
	if($_GET['do'] == 'disable'){
		$id = $_GET['id'];
		$sql = "UPDATE $tabl SET status='0' where id = '$id'";
		mysql_query($sql) or die(mysql_error());
	}
	
	$sqlq = $sql1;
	$sql2 = $sql1." ORDER BY $base_tabl.time, $base_tabl.status ASC LIMIT $stcom , $perpage";
	// pagination file include
	$page_val = "&date_from=$date_from&date_to=$date_to";
	include "include/pagination1.php";
	
	// get total amounts

	$totals_sql = "SELECT place_order.* from ".$from.$search_q;
	$totals_exec = mysql_query($totals_sql);
	$total =0;$num=0;$admin_share=0;
	while($totals_fetch = mysql_fetch_assoc($totals_exec)){
		if($totals_fetch['user_uniq'] <> ''){
			$total = $total + $totals_fetch['subtotal'] - $totals_fetch['discount_used'];	
		}
		else{
			$total = $total + $totals_fetch['subtotal'] - $totals_fetch['discount'];
		}
		$num++;
		$admin_share = $admin_share + $totals_fetch['admin_share'];
	}
	
	
}
//echo $sql2;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage <?php echo $item; ?>s</title>
<?php include("include/head.php"); ?>

<link rel="stylesheet" type="text/css" href="../css/dhtmlxcalendar.css">
</link>
<link rel="stylesheet" type="text/css" href="../css/dhtmlxcalendar_dhx_skyblue.css">
</link>
<script src="../js/dhtmlxcalendar.js"></script>
<script>
	var myCalendar;
	function doOnLoad() {
		myCalendar = new dhtmlXCalendarObject(["calendar1","calendar2","calendar3"]);
	}

	function show_hide(id){
		$('#1').hide();
		$('#2').hide();
		$('#3').hide();
		$('#'+id).show();
		return false;
	}

	$(document).ready(function(){
		doOnLoad();
	});
</script>

<script type="text/javascript">
	function reload_win(){
		location.reload();
	}
	$(document).ready(function() {
		$("#mainchbx").click(function() {
			var checked_status = this.checked;
			var checkbox_name = this.name;
			$("input[name=" + checkbox_name + "[]]").each(function() {
				this.checked = checked_status;
			});
		});
		$("input[name='chk[]']").click(function() {
			$("#mainchbx").attr('checked', false);
		});
		setTimeout(function() {
			$('.success').fadeOut('fast');
		}, 3000);
		setTimeout(function() {
			$('.error').fadeOut('fast');
		}, 3000);
	});
	function del_fun(){
		if(confirm("Are you sure you want to delete this Order?")){
			return true;
		}
		else{
			return false;
		}
	}

	function dis_fun(){
		if(confirm("Are you sure you want to mark this order as In Progress?")){
			return true;
		}
		else{
			return false;
		}
	}

	function enb_fun(){
		if(confirm("Are you sure you want to mark this order as Complete?")){
			return true;
		}
		else{
			return false;
		}
	}
</script>
</head>
<body>
<div align="center">
  <div class="container">
    <?php
		$ordr = 'active';
		require_once('include/header.php'); 
	?>
    <div class="content">
      <div style="margin-top: 20px;">
		<?php
              if($flagp == 'green'){
        ?>
			<div class="success">Success: <?php echo $item; ?> Deleted Successfully.</div>
        <?php 	
		}
		else if($flagg == 'g'){
		?>
			<div class="success">Success: <?php echo $item; ?> Deleted Successfully.</div>
        <?php
		}
		else if($flagr == 'r'){
		?>
			<div class="error">Error: No <?php echo $item; ?> selected</div> 
        <?php	
		}
		else if($flag_r == 'r'){
		?>
			<div class="error">Error: No <?php echo $item; ?> selected</div>
        <?php
		}
	    ?>
      </div>
      
    <form name="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <table width="873">
            <tbody>
                <tr>
                    <td>
                        Date From: 
                    </td>
                    <td>
                    	 <input id="calendar2" type="text" name="date_from" value="<?php echo $date_from; ?>"  />
                    </td>
                    <td>
                        Date To: 
                    </td>
                    <td>
                        <input id="calendar1" type="text" name="date_to" value="<?php echo $date_to; ?>"  />
                    </td>
                    <td>
                        Name: 
                    </td>
                    <td>
	                    <select name="user">
                        	<option value="">All</option>
                            <option value="guest" <?php echo $_GET['user'] == 'guest' ? 'selected="selected"': ''; ?>>Guest User</option>
                        	<?php

							$sql_user = "SELECT * from users order by id ASC";
							$exec_user = mysql_query($sql_user);
							while($fetch_user = mysql_fetch_assoc($exec_user)){
							?>
                            <option value="<?php echo $fetch_user['first_name']; ?>" <?php echo $_GET['user'] == $fetch_user['first_name'] ? 'selected="selected"': ''; ?>><?php echo $fetch_user['first_name']. " ".$fetch_user['last_name']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <input class="a_button"  style="margin-left:0px" type="submit" name="submitbut" value="Submit"  />
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
      <?php
	  if($time_frame == 'set'){
	  ?>
      <div style="text-align:left; margin:5px auto; width:950px;">
      	<table width="950" border="1" cellpadding="2" style="border:1px solid #ccc;">
        	<tr>
            	<td width="237">
                	<strong>Total No. of Orders placed:</strong> <?php echo $num; ?>
                </td>
            	<td width="181">
                	<strong>Total Amount:</strong> €<?php echo number_format($total,2); ?>
                </td>
                <td width="181">
                	<strong>Admin Share:</strong> €<?php echo number_format($admin_share,2); ?>
                </td>
            	
            	<td width="181">
                    <strong>Payable Amount:</strong> €<?php echo number_format($total,2); ?>
                </td>
			</tr>
        </table>                
        
      </div>
      <div class="down_category" style="margin-top:30px">
        <div class="head"> <span class="head_text"><?php echo $item; ?></span>
          <!--  <div class="add"> <a href="add_edit_<?php //echo strtolower($item); ?>.php"> <span class="add1"> <span class="head_text1"> <?php //echo $item; ?></span> </span> </a> </div>   -->       
            <div class="resetallpage"><a href="<?php echo $namep; ?>">Reset</a></div>
            <div class="search">
          <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          	<input name="date_from" value="<?php echo $date_from ?>" type="hidden" />
          	<input name="date_to" value="<?php echo $date_to ?>" type="hidden" />
            <input type="text" name="search" value="<?php if($search_txt ==''){$search_txt = 'search';}  echo $search_txt; ?>" onfocus="if(this.value=='search'){this.value=''}" onblur="if(this.value==''){this.value='search'}"/>
             <input type="submit" value="Search" name="Submitbut" class="side_search"  />
             </form>
              
          </div>
        </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>&order=<?php echo $order.'&field='.$field.'&search='.$search_txt; ?>" method="post" name="<?php echo $item; ?>">
    <input name="done" type="hidden" value="send" />
      <table width="100%" border="0" height="110" cellpadding="10" cellspacing="0"  class="maintbl" style="font-size:12px;">
         <tr class="fstrow"  >
<!--      	  <td width="5%">
          	<input class="check" type="checkbox" id="mainchbx" name="chk" />
          </td>
-->            <td align="left" width="10%">
          	Order Id
          </td>
            <td align="left" width="15%">
          	Name
          </td>
          <td align="left" width="12%">
          Total Amount
          </td>
          <td align="left" width="12%">
         Admin Share
          </td>
          <td align="center" width="8%">
          Status
          </td>
<!--          <td align="center" width="20%">
          	Actions
          </td>
-->          </tr>
        
        
			<?php
                $exec = mysql_query($sql2) or die(mysql_error());
				if(mysql_num_rows($exec) == 0){
					echo '<tr class="scndrow"><td colspan="7" align="center"><div style="margin-top:10px;">No result Found</div></td></tr>';
				}
				else{
                $z = 0;
                while($fetch = mysql_fetch_assoc($exec)){
            ?>
            <tr class="scndrow">
              <div class="blue2">
<!--              <td>
               <input type='checkbox' name='chk[]' value='<?php echo $fetch[id] ?>' id='checkme<?php echo $z; ?>' />
               </td >
-->
                <td align="left" >
                <div class="n_1"><?php echo $fetch['bid']; ?></div>
                </td>
                <td align="left" >
                <div class="n_1"><?php if($fetch['first_name'] <> ''){ echo $fetch['first_name'].' '.$fetch['last_name'];} else{ echo 'Guest User';} ?></div>
                </td>
                   <td align="left" >
                <div class="n_1"><?php if($fetch['user_uniq'] <> ''){ echo number_format($fetch['subtotal'] - $fetch['discount_used'],2);} else{ echo number_format($fetch['subtotal'] - $fetch['discount'],2);}?> €</div>
                </td>
                <td align="left" >
                <div class="n_1"><?php echo $fetch['admin_share'];?> €</div>
                </td>
                 <td align="center"><?php
					if($fetch['status'] == '1'){
				?>
                Completed <!--<a href='<?php echo $_SERVER['PHP_SELF']; ?>?date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>&do=disable&id=<?php echo $fetch[id].'&page='.$page.'&categ='.$categ.'&search='.$search_init; ?>' onclick='return dis_fun();'><img src='images/enabled.gif' title='Disable' width='16' height='16' /></a>-->
                <?php
					}
					else{
				?>
               In Progress<!-- <a href='<?php echo $_SERVER['PHP_SELF']; ?>?date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>&do=enable&id=<?php echo $fetch[id].'&page='.$page.'&categ='.$categ.'&search='.$search_init; ?>' onclick='return enb_fun();'><img src='images/disabled.gif' title='Enable' width='16' height='16' /></a>-->
                <?php
					}
				?></td>
                <!-- <td align="center">
                <div class="n_2">
                <a href="sort_gen.php?type=name&tab=<?php echo $tabl; ?>&height=500&width=600&rel=<?php echo $fetch[id]; ?>" class="thickbox"><img src="images/sort-neither.png" title="Sort" width="13" height="16" /></a>
                </div>
                </td> -->
                
             
                <!--<td align="center">
                 <div style="margin-left:0px; float:left;  " class="managetipsdiv"><div class="view"> <a href="view_orders.php?id=<?php echo $fetch[id]; ?>" title="View"> <img src="images/view.png" /> </a> </div></div>
                    <div style="margin-left:2px; float:left;  " class="managetipsdiv"><div class="view"> <a href="<?php echo $_SERVER['PHP_SELF'].'?do=delete&id='.$fetch[id]; ?>&date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>" title="Delete" onclick="return del_fun();"> <img src="images/delete.png" /> </a> </div>
                </div>
                </td>-->
              </div>
            </tr>
            
            <?php $z++; } }?>
         
        </table>
<!--      <div class="slideshowdelend">
		<input onclick="return del_fun();" type="submit" name="Delete" value="Delete Selected" class="formbutton" />
      </div>
-->
      </form>
      </div>
      <?php require("include/pagination_show.php"); 
	  	 include "include/footerlogo.php";
	  ?>
    </div>
    <?php } ?>
    <div class="clear"></div>
  </div>
</div>
</body>
</html>

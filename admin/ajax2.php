<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("../config.php");

//this is for select area according to city
if($_GET['do'] == 'sel_city'){ 

	$city =  mysql_real_escape_string($_GET['city']);
	 $sql = "select * from city where city='".$city."'"; 
	$exec = mysql_query($sql);
	$fetch=mysql_fetch_assoc($exec);
	
	$sqlm = "select * from area where city='".$fetch['id']."'";
	$execm = mysql_query($sqlm);
	$num1 = mysql_num_rows($execm);
	
	if($num1 >0){
	while($name=mysql_fetch_assoc($execm)){
	$sql1 = "select * from user where area='".$name['area']."' and uniq_id='".$fetch_user['uniq_id']."'";
	$exec1 = mysql_query($sql1);
	$fetch1=mysql_fetch_assoc($exec1);
	 if($name['area']==$fetch1['area']){$select = "selected='selected'";}
	 else{$select = "";}
	$message[1] .= "<option value='".$name['area']."' ".$select.">".$name['area']."</option>";
		}
		$message[0] = 'Success';
		}
	else{$message[0] = 'error';}
//material	
	
	$message[2] = $city;
	 ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;

}

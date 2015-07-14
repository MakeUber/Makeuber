
<?php

//user section
if(isset($_COOKIE['rem'])){
	$uniqc = mysql_real_escape_string($_COOKIE['rem']);
	$sql = "SELECT count(*) from user where uniq_id='".$uniqc."'";
	$exec = mysql_query($sql);
	list($numc) = mysql_fetch_row($exec);
	
	if($numc == '1'){
		$_SESSION['user'] = $uniqc;
	}
}

if(isset($_SESSION['user'])){
	$uniqc = mysql_real_escape_string($_SESSION['user']);
	$sql = "SELECT * from user where uniq_id='".$uniqc."'"; 
	$exec = mysql_query($sql);
	$fetch_user = mysql_fetch_assoc($exec);
	$user_status='1';
	$user_uniq = $fetch_user['uniq_id'];
	
	
	
}

?>
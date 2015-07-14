<?php 
include('init.php');
include('config_db.php');
include('config.php');
// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outpus it.

$query = "SELECT * from area where status='1'" ; 
 

/*while ( $row = mysql_query( $query ) ) 
{ 
	$row ['area'] ;  
}*/
$row = mysql_query ( $query  )  ;
while ( $rowa  = mysql_fetch_assoc($row ) ) 
{
echo json_encode ( $rowa ['area'  ] ) ;
}

?> 
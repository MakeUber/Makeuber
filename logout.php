<?php
echo "Hello" ;
session_start();
session_destroy();
header("location:Index.php");
?>

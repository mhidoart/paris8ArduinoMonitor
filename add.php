<?php
header('Access-Control-Allow-Origin: *');

   	include("connect.php");

	$temp1=$_GET["temp1"];
	$hum1=$_GET["hum1"];

	$query = "INSERT INTO `tempLog` (`timeStamp`,`temperature`, `humidity`) 
		VALUES ('".date('Y-m-d')."','".$temp1."','".$hum1."')"; 
   	echo $query;
   	$db->executeQuery($query);
   	echo "ok" . $temp1 . "  " .$hum1;

   //	header("Location: index.php");
?>

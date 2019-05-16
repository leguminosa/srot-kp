<?php

include "includes/config.php";
if(isset($_GET["sikhapus"]))
{
	$No_SIK = $_GET['sikhapus'];
	
	mysqli_query($connection, "DELETE FROM sik WHERE No_SIK='$No_SIK'");
	header("location:sik.php");
	
	}

?>
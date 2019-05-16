<?php

include "includes/config.php";
if(isset($_GET["ormahapus"]))
{
	$Kd_ORMA = $_GET['ormahapus'];
	
	mysqli_query($connection, "DELETE FROM orma WHERE Kd_ORMA='$Kd_ORMA'");
	header("location:orma.php");
	
	}

?>
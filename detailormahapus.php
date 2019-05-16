<?php

include "includes/config.php";
if(isset($_GET["detailormahapus"]))
{
	$Kd_KetuaORMA = $_GET['detailormahapus'];
	
	mysqli_query($connection, "DELETE FROM detail_ketuaorma WHERE Kd_KetuaORMA='$Kd_KetuaORMA'");
	header("location:detailorma.php");
	
	}

?>
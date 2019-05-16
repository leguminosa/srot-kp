<?php

include "includes/config.php";
if(isset($_GET["detailLpjhapus"]))
{
	$Kd_detailLPJ = $_GET['detailLpjhapus'];
	
	mysqli_query($connection, "DELETE FROM detaillpj WHERE Kd_detailLPJ='$Kd_detailLPJ'");
	header("location:detailLpj.php");
	
	}

?>
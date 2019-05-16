<?php

include "includes/config.php";
if(isset($_GET["lpjhapus"]))
{
	$No_LPJ = $_GET['lpjhapus'];
	
	mysqli_query($connection, "DELETE FROM lpj WHERE No_LPJ='$No_LPJ'");
	header("location:lpj.php");
	
	}

?>
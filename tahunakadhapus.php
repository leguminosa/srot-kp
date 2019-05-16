<?php

include "includes/config.php";
if(isset($_GET["tahunakadhapus"]))
{
	$Periode_th_akad = $_GET['tahunakadhapus'];
	
	mysqli_query($connection, "DELETE FROM th_akad WHERE Periode_th_akad='$Periode_th_akad'");
	header("location:tahunakad.php");
	
	}

?>
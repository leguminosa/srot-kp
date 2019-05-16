<?php

include "includes/config.php";
if(isset($_GET["kegiatanhapus"]))
{
	$Kd_kegiatan = $_GET['kegiatanhapus'];
	
	mysqli_query($connection, "DELETE FROM kegiatan WHERE Kd_kegiatan='$Kd_kegiatan'");
	header("location:kegiatan.php");
	
	}

?>
<?php

include "includes/config.php";
if(isset($_GET["kategorihapus"]))
{
	$Kd_kategori = $_GET['kategorihapus'];
	
	mysqli_query($connection, "DELETE FROM kategorikegiatan WHERE Kd_kategori='$Kd_kategori'");
	header("location:kategorikegiatan.php");
	
	}

?>
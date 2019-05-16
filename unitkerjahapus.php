<?php

include "includes/config.php";
if(isset($_GET["unitkerjahapus"]))
{
	$Id_unitkerja = $_GET['unitkerjahapus'];
	
	mysqli_query($connection, "DELETE FROM unitkerja WHERE Id_unitkerja='$Id_unitkerja'");
	header("location:unitkerja.php");
	
	}

?>
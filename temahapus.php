<?php

include "includes/config.php";
if(isset($_GET["temahapus"]))
{
	$ID_pembicara = $_GET['temahapus'];
	
	mysqli_query($connection, "DELETE FROM temaseminar WHERE ID_seminar='$ID_seminar'");
	header("location:temahapus.php");
	
	}

?>
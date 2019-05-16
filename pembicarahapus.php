<?php

include "includes/config.php";
if(isset($_GET["pembicarahapus"]))
{
	$ID_pembicara = $_GET['pembicarahapus'];
	
	mysqli_query($connection, "DELETE FROM pembicara WHERE ID_pembicara='$ID_pembicara'");
	header("location:Pembicara.php");
	
	}

?>
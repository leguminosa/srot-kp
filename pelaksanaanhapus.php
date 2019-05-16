<?php

include "includes/config.php";
if(isset($_GET["pelaksanaanhapus"]))
{
	$ID = $_GET['pelaksanaanhapus'];
	
	mysqli_query($connection, "DELETE FROM pelaksanaanseminar WHERE ID='$ID'");
	header("location:PelaksanaanSeminar.php");
	
	}

?>
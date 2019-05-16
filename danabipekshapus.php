<?php

include "includes/config.php";
if(isset($_GET["danabipekshapus"]))
{
	$Kd_bipeks = $_GET['danabipekshapus'];
	
	mysqli_query($connection, "DELETE FROM dana_bipeks WHERE Kd_bipeks='$Kd_bipeks'");
	header("location:danabipeks.php");
	
	}

?>
<?php 
	include "includes/config.php"; 	
	if(isset($_GET["univhapus"]))
	{
		$univKODE = $_GET['univhapus'];
		mysqli_query($connection, "DELETE FROM universitas WHERE univKODE='$univKODE'");
		header("location: Universitas.php");
	}
?>
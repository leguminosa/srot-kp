<?php

include "includes/config.php";
if(isset($_GET["tembusanhapus"]))
{
	$Kd_Tembusan = $_GET['tembusanhapus'];
	
	mysqli_query($connection, "DELETE FROM tembusan WHERE Kd_Tembusan='$Kd_Tembusan'");
	header("location:tembusan.php");
	
	}

?>
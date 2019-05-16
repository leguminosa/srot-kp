<?php

include "includes/config.php";
if(isset($_GET["detailTembusanhapus"]))
{
	$id = $_GET['detailTembusanhapus'];
	
	mysqli_query($connection, "DELETE FROM sik_tembusan WHERE id='$id'");
	header("location:detailTembusan.php");
	
	}

?>
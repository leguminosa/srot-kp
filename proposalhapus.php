<?php

include "includes/config.php";
if(isset($_GET["proposalhapus"]))
{
	$No_proposal = $_GET['proposalhapus'];
	
	mysqli_query($connection, "DELETE FROM proposal WHERE No_proposal='$No_proposal'");
	header("location:proposal.php");
	
	}

?>
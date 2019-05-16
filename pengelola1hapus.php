<?php

include "includes/config.php";
if(isset($_GET["pengelola1hapus"]))
{
	$Id_admin = $_GET['pengelola1hapus'];
	
	mysqli_query($connection, "DELETE FROM admin WHERE Id_admin='$Id_admin'");
	header("location:pengelola1.php");
	
	}

?>
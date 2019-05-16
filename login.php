<?php
ob_start();
session_start();
if(isset($_SESSION['admin_NAMA']))
	header("location:index.php");
include "includes/config.php";
if(isset($_POST["submit_login"])) {
	
	$Email = $_POST["Email"];
	$Password = $_POST["Password"];
	$sql_login = mysqli_query($connection, "SELECT * FROM admin 
	WHERE Email = '$Email' AND Password = '$Password'");
	if(mysqli_num_rows($sql_login) > 0) {
		$row_admin = mysqli_fetch_array($sql_login);
		$_SESSION['admin_KODE'] = $row_admin["Id_admin"];
		$_SESSION['admin_EMAIL'] = $row_admin["Email"];
		header("location:index.php");
	}
}

?>


<html lang="en" >
<head>
	<meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" >
	<link href="css/loginstyle.css" rel="stylesheet" >
</head>

<body>
    <div class="wrapper">
    <form class="form-signin">       
      <h2 class="form-signin-heading">Silahkan Login </h2>
      <input type="text" class="form-control" name="username" placeholder="Alamat Email" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
      <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Lupa Password
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>
</body>
</html>

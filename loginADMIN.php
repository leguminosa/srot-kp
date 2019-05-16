<?php
ob_start();
session_start();
if(isset($_SESSION['admin_EMAIL']))
	header("location:indexADMIN.php");
include "includes/config.php";
if(isset($_POST["submit_login"])) {

	$Email = $_POST["Email"];
	$Password = $_POST["Password"];
	$sql_login = mysqli_query($connection, "SELECT * FROM user
	WHERE email_user = '$Email' AND password = '$Password'");
	if(mysqli_num_rows($sql_login) > 0) {
		$row_admin = mysqli_fetch_array($sql_login);
		$_SESSION['admin_KODE'] = $row_admin["id_user"];
		$_SESSION['admin_EMAIL'] = $row_admin["email_user"];
		$_SESSION['admin_NAMA'] = $row_admin["nama_user"];
		$_SESSION['usertype'] = $row_admin["keterangan"];
		header("location:indexADMIN.php");
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
    <form class="form-signin" action="loginADMIN.php" method="POST">
      <h2 class="form-signin-heading">Silahkan Login </h2>
      <input type="text" class="form-control" name="Email" placeholder="Alamat Email" required="" autofocus="" />
      <input type="password" class="form-control" name="Password" placeholder="Password" required=""/>
      <!-- <label class="checkbox"> -->
        <!-- <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Lupa Password -->
      <!-- </label> -->
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit_login" value="Login">Login</button>
			<br>
			<h5 class="judul">Belum punya akun? <a href="daftar.php" role="button">Daftar disini</a></h5>
    </form>
  </div>
</body>
</html>

<?php
mysqli_close($connection);
ob_end_flush();

?>

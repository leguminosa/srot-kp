<?php
	include ("includes/config.php");

	$id = $_SESSION["admin_KODE"];
	$jabatan = $_SESSION["usertype"];
//	print_r($id."<br>");
// 	$profil = mysqli_query($connection, "SELECT * FROM user WHERE id_user = '$id'");
// //	print_r($profil);
// 	if(mysqli_num_rows($profil)>0) {
// //		while($row = mysqli_fetch_array($profil)) {
// 		$row = mysqli_fetch_array($profil);
// 		$jabatan = $row["keterangan"];
// //			print_r($jabatan);
// //		}
// 	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SROT-KP</title>

  <link rel="shortcut icon" href="images/logo.jpg"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/menuvertical.css" rel="stylesheet" type="text/css">
	<link href="assets/plugins/select2/4.0.6/dist/css/select2.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="row affix-row">
<div class="col-sm-3 col-md-2 affix-sidebar">
<div class="sidebar-nav">
	<div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <span class="visible-xs navbar-brand">Sidebar menu</span>
    </div>
    <div class="navbar-collapse collapse sidebar-navbar-collapse">
      <ul class="nav navbar-nav" id="sidenav01">
        <li class="active">
          <a href="indexADMIN.php" data-toggle="collapse" data-target="#toggleDemo0" data-parent="#sidenav01" class="collapsed">
          <h4>Hello <?php echo $_SESSION['admin_NAMA']; ?> !</h4>
          </a>
        </li>

      <!--  <li><a href="Universitas.php"><span class="glyphicon glyphicon-pencil"></span> Admin</a></li> -->
<?php 	if(strtolower($jabatan) == "admin") { ?>
		<li><a href="supir.php"><span class="glyphicon glyphicon-pencil"></span> Supir</a></li>
		<li><a href="jenis.php"><span class="glyphicon glyphicon-pencil"></span> Jenis</a></li>
		<li><a href="kendaraan.php"><span class="glyphicon glyphicon-pencil"></span> Kendaraan</a></li>
		<li><a href="truck.php"><span class="glyphicon glyphicon-pencil"></span> Trucking</a></li>
		<li><a href="ongoing_orders.php"><span class="glyphicon glyphicon-pencil"></span> Truk Yang Dipesan</a></li>
		<li><a href="booking_report.php"><span class="glyphicon glyphicon-pencil"></span> Laporan Pemesanan</a></li>
		<!-- <li><a href="pengelola1.php"><span class="glyphicon glyphicon-pencil"></span> Admin</a></li>
        <li><a href="unitkerja.php"><span class="glyphicon glyphicon-pencil"></span> Unit Kerja</a></li>
		<li><a href="tahunakad.php"><span class="glyphicon glyphicon-pencil"></span> Tahun Akad</a></li>
		<li><a href="kategorikegiatan.php"><span class="glyphicon glyphicon-pencil"></span> Kategori Kegiatan</a></li>
		<li><a href="orma.php"><span class="glyphicon glyphicon-pencil"></span> Organisasi Mahasiswa</a></li>
		<li><a href="detailorma.php"><span class="glyphicon glyphicon-pencil"></span> Detail Organisasi Mahasiswa</a></li>
		<li><a href="danabipeks.php"><span class="glyphicon glyphicon-pencil"></span> Dana Bipekstur</a></li>
		<li><a href="kegiatan.php"><span class="glyphicon glyphicon-pencil"></span> Dana Kegiatan Proker</a></li>
		<li><a href="tembusan.php"><span class="glyphicon glyphicon-pencil"></span> Tembusan</a></li>
		<li><a href="laporan.php"><span class="glyphicon glyphicon-pencil"></span> Laporan</a></li> -->
<?php 	} else { ?>
		<li><a href="katalog.php"><span class="glyphicon glyphicon-search"></span> Katalog</a></li>
		<li><a href="order.php"><span class="glyphicon glyphicon-list"></span> Order</a></li>
<?php 	} ?>
		<!-- <li><a href="proposal.php"><span class="glyphicon glyphicon-pencil"></span> Proposal</a></li> -->
		<!-- <li><a href="sik.php"><span class="glyphicon glyphicon-pencil"></span> SIK</a></li> -->
		<!-- <li><a href="detailTembusan.php"><span class="glyphicon glyphicon-pencil"></span> Detail Tembusan</a></li> -->
		<!-- <li><a href="lpj.php"><span class="glyphicon glyphicon-pencil"></span> LPJ</a></li> -->
    <!-- <li><a href="detailLpj.php"><span class="glyphicon glyphicon-pencil"></span> Detail LPJ</a></li> -->
		<li><a href="logoutADMIN.php"><span class="glyphicon glyphicon-off"></span> Sign Out</a></li>
      </ul>
    </div><!-- petnutup nav-collapse -->
    </div>
</div>
</div>

<div class="col-sm-9 col-md-10 affix-content">

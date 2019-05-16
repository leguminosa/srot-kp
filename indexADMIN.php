<!-- ADMIN index -->
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

	include ("includes/config.php");
	include ("adminmenu.php");

	//BERIKUT CARA PAKE
	require_once("includes/classes/User.php");

	$test = new User();
	$test = $test->selectAll();
	$test = mysqli_query($connection, $test);
	while ($row = mysqli_fetch_array($test)) {
		echo "<pre>";
		var_dump($row);
	}
?>

<?php
if(isset($_GET['Kd_ORMA'])) {
	$cari = $_GET["Kd_ORMA"];
	//print_r($cari);

	// $carr = "SELECT d.Bipeks_total, d.Kd_ORMA, d.Kd_bipeks, d.bipeks_sisa, d.Periode_th_akad, s.No_SIK, l.No_LPJ, p.No_proposal
	// FROM LPJ l, SIK s, Proposal p, Kegiatan k, dana_bipeks d
	// WHERE
	// l.No_SIK = s.No_SIK AND
	// s.No_proposal = p.No_proposal AND
	// p.Kd_kegiatan = k.Kd_kegiatan AND
	// k.Kd_bipeks = d.Kd_bipeks AND
	// d.Kd_ORMA LIKE '%$cari%'";
	$carr = "SELECT o.Nama_ORMA, k.Nama_kegiatan, d.Bipeks_total, p.Bipeks_terprogram, p.No_proposal, s.No_SIK, l.No_LPJ, d.Periode_th_akad
	FROM proposal p LEFT JOIN sik s ON p.No_proposal = s.No_proposal LEFT JOIN lpj l ON s.No_SIK = l.No_SIK, kegiatan k, dana_bipeks d, orma o
	WHERE p.Kd_kegiatan = k.Kd_kegiatan AND
	k.Kd_bipeks = d.Kd_bipeks AND
	d.Kd_ORMA = o.Kd_ORMA AND
	o.Nama_ORMA LIKE '%$cari%'";

	$query_cari = mysqli_query($connection, $carr);
//	print_r($query_cari);


/** Memasukkan data fullname ke dalam tabel PelaksanaanSeminar**/
     //mysqli_query($connection, "INSERT INTO dana_bipeks VALUES ('$Kd_bipeks','$Bipeks_total',
	// '$Periode_th_akad','$Kd_ORMA','$Bipeks_total')");
//     header("location:danabipeks.php");
}

$query = mysqli_query($connection, "SELECT Bipeks_total FROM dana_bipeks");
$Periode_th_akadquery = mysqli_query ($connection, "SELECT Periode_th_akad FROM tahunakad");
$No_SIK = mysqli_query($connection, "SELECT No_SIK FROM sik");
$No_LPJ = mysqli_query($connection, "SELECT No_LPJ FROM lpj");
// $query_sisa = "SELECT d.Bipeks_total, d.Kd_ORMA, d.Kd_bipeks, d.bipeks_sisa, d.Periode_th_akad, s.No_SIK, l.No_LPJ, p.No_proposal
// FROM LPJ l, SIK s, Proposal p, Kegiatan k, dana_bipeks d
// WHERE
// l.No_SIK = s.No_SIK AND
// s.No_proposal = p.No_proposal AND
// p.Kd_kegiatan = k.Kd_kegiatan AND
// k.Kd_bipeks = d.Kd_bipeks";
$query_sisa = "SELECT o.Nama_ORMA, k.Nama_kegiatan, d.Bipeks_total, p.Bipeks_terprogram, p.No_proposal, s.No_SIK, l.No_LPJ, d.Periode_th_akad
FROM proposal p LEFT JOIN sik s ON p.No_proposal = s.No_proposal LEFT JOIN lpj l ON s.No_SIK = l.No_SIK, kegiatan k, dana_bipeks d, orma o
WHERE p.Kd_kegiatan = k.Kd_kegiatan AND
k.Kd_bipeks = d.Kd_bipeks AND
d.Kd_ORMA = o.Kd_ORMA";
$sisa_dana = mysqli_query($connection, $query_sisa);
$dana_terpakai = mysqli_query($connection,"select sum(Bipeks_terprogram),Kd_kegiatan, Nama_kegiatan, Bipeks_terprogram from proposal group by (Kd_kegiatan)");
//$cari = mysqli_query($connection, "select * from dana_bipeks left join orma on dana_bipeks.Kd_ORMA = orma.Kd_ORMA");
?>


	<div class="jumbotron" style="margin-top: -50px" >
		<div class="container text-justify">
			<h2>HALAMAN PENGINPUTAN</h2>
			<p><?php echo $_SESSION['admin_NAMA']; ?> dapat menginput data kegiatan Direktorat Kemahasiswaan dan Alumni.
			Data tersebut tersimpan dalam database DITMAWA </p>
	</div>



	</div>	<!-- Akhir dari Jumbotron -->

	<div>
	<form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" class="form-control" name="Kd_ORMA" placeholder="Search Organisasi Mahasiswa">
            </div>
            <button type="submit" value="cari" class="btn btn-default">Submit</button>
			<a href="indexADMIN.php" role="button" class="btn btn-primary">View All</a>

          </form>
		  <a href="printhome.php">Print</a><br>
	</div>
	<table class="table table-hover">
		<div class="etri-form">
			<br><br><br><h1><b></b></h1>
		</div>

	<tr class="info">
				<th>NO</th>
				<th>Organisasi Mahasiswa</th>
				<th>Nama Kegiatan</th>
				<th>Total Bipeks</th>
				<th>Bipeks Terprogram</th>
				<th>No Proposal</th>
				<th>No SIK</th>
				<th>NO LPJ</th>
				<th>Periode</th>


	</tr>


	<?php
		/** Memeriksa apakah data yang dipanggil tersebut tersedia atau tidak **/
	if(isset($_GET['Kd_ORMA'])) {

		if(mysqli_num_rows($query_cari)>0) {
			$no=1;
			while ($row_cari = mysqli_fetch_array($query_cari)) {
				$row2 = mysqli_fetch_array($dana_terpakai)
	?>
				<tr class="danger" height="20px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row_cari['Nama_ORMA']; ?> </td>
					<td><?php echo $row2['Nama_kegiatan']; ?> </td>
					<td><?php echo $row_cari['Bipeks_total']; ?> </td>
					<td><?php echo $row2['Bipeks_terprogram']; ?> </td>
					<!--<td><?php // echo $row_cari['Kd_bipeks']; ?> </td> -->
					<!--<td><?php // echo $row_cari['bipeks_sisa'] ?> </td> -->
					<td><?php echo $row_cari['No_proposal'] ?> </td>
					<td><?php echo $row_cari['No_SIK']; ?> </td>
					<td><?php echo $row_cari['No_LPJ']; ?> </td>
					<td><?php echo $row_cari['Periode_th_akad'] ?> </td>
					<!-- <li><a href="printhome.php">Print</a></li> -->
				</tr>
				<?php $no++; ?>
				<?php
		}}
		} else if(mysqli_num_rows($query)>0)
	{?>
		<?php $no=1; ?>
		<?php while ($row = mysqli_fetch_array($sisa_dana))
			{ $row2 = mysqli_fetch_array($dana_terpakai)?>
				<tr class="danger" height="20px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row['Nama_ORMA']; ?> </td>
					<td><?php echo $row2['Nama_kegiatan']; ?> </td>
					<td><?php echo $row['Bipeks_total']; ?> </td>
					<td><?php echo $row2['Bipeks_terprogram']; ?> </td>
					<td><?php echo $row['No_proposal'] ?> </td>
					<td><?php echo $row['No_SIK']; ?> </td>
					<td><?php echo $row['No_LPJ']; ?> </td>
					<td><?php echo $row['Periode_th_akad'] ?> </td>

				</tr>
				<?php $no++; ?>
			<?php  } ?>
	<?php  } ?>



	</table>

<?php include ("adminfooter.php") ?>

<?php
mysqli_close($connection);
ob_end_flush();
?>

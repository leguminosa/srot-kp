

<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {
		if (isset($_REQUEST["Kd_kegiatan"]))
			{	$Kd_kegiatan = $_REQUEST["Kd_kegiatan"];
			}
		if (!empty($Kd_kegiatan))
			{	$Kd_kegiatan = $_POST['Kd_kegiatan'];
			}
		$Nama_kegiatan = $_POST['Nama_kegiatan'];
		$Waktu_pelaksanaan = $_POST['Waktu_pelaksanaan'];
		$Ketua_pelaksana = $_POST['Ketua_pelaksana'];
		$Bipeks_terprogram = $_POST['Bipeks_terprogram'];
		$Kd_bipeks = $_POST['Kd_bipeks'];


/** Memasukkan data fullname ke dalam tabel PelaksanaanSeminar**/
     mysqli_query($connection, "INSERT INTO kegiatan VALUES ('$Kd_kegiatan','$Nama_kegiatan',
	 '$Waktu_pelaksanaan','$Ketua_pelaksana', '$Bipeks_terprogram','$Kd_bipeks')");
	 mysqli_query($connection, "UPDATE dana_bipeks SET bipeks_sisa = (bipeks_sisa - ".$Bipeks_terprogram.")  WHERE Kd_bipeks = ".$Kd_bipeks);
     header("location:kegiatan.php");
     }

	 if(isset($_GET['Kd_bipeks'])) {
 	$cari = $_GET["Kd_bipeks"];
 	//print_r($cari);
 	$query_cari = mysqli_query($connection, "SELECT kegiatan.*, dana_bipeks.Kd_ORMA
 		FROM dana_bipeks, kegiatan, orma WHERE kegiatan = 'Kd_bipeks' AND dana_bipeks = 'Kd_bipeks'
 		Kd_bipeks LIKE '%$cari%'");
 	// print_r($query_cari);



 /** Memasukkan data fullname ke dalam tabel PelaksanaanSeminar**/
      //mysqli_query($connection, "INSERT INTO dana_bipeks VALUES ('$Kd_bipeks','$Bipeks_total',
 	// '$Periode_th_akad','$Kd_ORMA','$Bipeks_total')");
 //     header("location:danabipeks.php");
 	}


	 $query = mysqli_query($connection,
	 	"SELECT k.*, o.Nama_ORMA
		 FROM kegiatan k, dana_bipeks d, orma o
		 WHERE k.Kd_bipeks = d.Kd_bipeks AND
 		d.Kd_ORMA = o.Kd_ORMA");
	 $Kd_bipeksquery = mysqli_query ($connection, "SELECT * FROM dana_bipeks ORDER BY Kd_bipeks ASC");
	 /**$Kd_ORMAquery = mysqli_query ($connection, "SELECT * FROM orma ORDER BY Kd_ORMA ASC"); **/
?>

<?php include("adminmenu.php") ?>

<div class="templatemo-content-wrapper">
<div class="templatemo-content entri-form">
	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>ENTRI DATA PROKER</h1><br>
	</div>
<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		<!--  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_kegiatan">Kode Kegiatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Kd_kegiatan" name="Kd_kegiatan" placeholder="Kode Kegiatan"
			  maxlength="10" required="">
			</div>
		  </div> -->

		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_bipeks">Nama Organisasi</label>
			<div class="col-md-6 col-sm-6 col-xs-6">
            <select id="Nama_ORMA" name="Nama_ORMA" class="form-control">
			<option value="Kd_bipeks">NULL</option>
			<?php if (mysqli_num_rows($Kd_bipeksquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($Kd_bipeksquery)) {?>
					<option>
						<?php echo $row["Kd_bipeks"]?>
						<?php echo $row["Kd_ORMA"]?>
						<?php echo $row["Periode_th_akad"]?>

					</option>
				<?php } ?>
			<?php } ?>

			</select>
			</div>
		  </div>

		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_kegiatan">Nama Kegiatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_kegiatan" name="Nama_kegiatan" placeholder="Nama Kegiatan">
			</div>
		  </div>
		 <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Waktu_pelaksanaan">Waktu Pelaksanaan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Waktu_pelaksanaan" name="Waktu_pelaksanaan" placeholder="Waktu Pelaksanaan">
			</div>
		  </div>

		 <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Ketua_pelaksana">Ketua Pelaksanaan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Ketua_pelaksana" name="Ketua_pelaksana" placeholder="Ketua Pelaksanaan">
			</div>
		  </div>

		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Bipeks_terprogram">Bipekstur Terprogram</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Bipeks_terprogram" name="Bipeks_terprogram" placeholder="Bipekstur Terprogram">
			</div>
		  </div>



		<!--  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_ORMA">Kode Orma</label>
			<div class="col-sm-2">
			<select name="Kd_ORMA" class="form-control">
			<option value="Kd_ORMA">NULL</option>
			<?php if (mysqli_num_rows($Kd_ORMAquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($Kd_ORMAquery)) {?>
					<option>
						<?php echo $row["Kd_ORMA"]?>

					</option>
				<?php } ?>
			<?php } ?>

			</select>
			</div>
		  </div>
<!--
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tugas">Tugas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tugas" name="Tugas" placeholder="Tugas">
			</div>
		  </div>


		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Judul_materi">Judul materi</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Judul_materi" name="Judul_materi" placeholder="Judul materi">
			</div>
		  </div> -->

		  <div class="col-sm-3">

		  </div>
		  <div class="col-sm-4">
			<input class="btn btn-lg btn-primary" type="submit" value="Simpan" name="Simpan">
			<!-- tombol diperbesar dg -lg dan berwarna biru dengan -primary -->
			<input class="btn btn-lg btn-info" type="reset" value="Batal"> <!-- tombol berwarna hijau langit -->
		  </div>
		</form>

	<!--<div>
	<form class="navbar-form navbar-right">

            <div class="form-group" >
              <input type="text" class="form-control" name="Kd_bipeks" placeholder="Search Organisasi Mahasiswa">
            </div>
            <button type="submit" value="cari" class="btn btn-default">Submit</button>

	</form>

</div> -->


	<table class="table table-hover">
		<div class="etri-form">
			<br><br><br><h1><b>HASIL ENTRI PROKER</b></h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Kode Kegiatan</th>
				<th>Nama Organisasi</th>
				<th>Nama Kegiatan</th>
				<th>Waktu Pelaksanaan</th>
				<th>Ketua Pelaksanaan</th>
				<th>Bipekstur Terprogram</th>
				<th>Kode Bipekstur</th>

				<th>ACTION</th>
	</tr>
	<?php
		/** Memeriksa apakah data yang dipanggil tersebut tersedia atau tidak **/
		if(mysqli_num_rows($query)>0)

			if(isset($_GET['Kd_bipeks'])) {
				if(mysqli_num_rows($query_cari)>0) {

			$no=1;
			while ($row_cari = mysqli_fetch_array($query_cari)) {
				?>
				<tr class="danger" height="20px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row_cari['Kd_ORMA'] ?> </td>
					<td><?php echo $row_cari['Nama_ORMA'] ?> </td>
					<td><?php echo $row_cari['Kd_kegiatan']; ?> </td>
					<td><?php echo $row_cari['Nama_kegiatan']; ?> </td>
					<td><?php echo $row_cari['Waktu_pelaksanaan']; ?> </td>
					<td><?php echo $row_cari['Ketua_pelaksana'] ?> </td>
					<td><?php echo $row_cari['Bipeks_terprogram'] ?> </td>
					<td><?php echo $row_cari['Kd_bipeks'] ?> </td>

				</tr>
				<?php $no++; ?>
				<?php
		}}
		} else if(mysqli_num_rows($query)>0)


	{?>
		<?php $no=1; ?>
		<?php while ($row = mysqli_fetch_array($query))
			{ ?>
				<tr class="danger" height="20px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row['Kd_kegiatan']; ?> </td>
					<td><?php echo $row['Nama_ORMA']; ?> </td>
					<td><?php echo $row['Nama_kegiatan']; ?> </td>
					<td><?php echo $row['Waktu_pelaksanaan']; ?> </td>
					<td><?php echo $row['Ketua_pelaksana']; ?> </td>
					<td><?php echo $row['Bipeks_terprogram']; ?> </td>
					<td><?php echo $row['Kd_bipeks']; ?> </td>


					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="kegiatanubah.php?kegiatanubah=<?php echo $row["Kd_kegiatan"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i></a>
						<a href="kegiatanhapus.php?kegiatanhapus=<?php echo $row["Kd_kegiatan"]?>">   Delete</a>
					</td>
				</tr>
				<?php $no++; ?>
			<?php  } ?>
	<?php  } ?>
	</table>
	</div>
</div>
</div>
</div>

<?php include("adminfooter.php") ?>

<script>

$("#Nama_ORMA").select2({ placeholder: "Silahkan pilih" });
</script>

<?php
mysqli_close($connection);
ob_end_flush();

?>

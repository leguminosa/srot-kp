
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {
//		print_r($_POST); die();
		if (isset($_REQUEST["No_proposal"]))
			{	$No_proposal = $_REQUEST["No_proposal"];
			}
		if (!empty($No_proposal))
			{	$No_proposal = $_POST['No_proposal'];
			}
		$kegiatan = $_POST['Kd_kegiatan'];
		$kegiatan = explode("^", $kegiatan);
		$Kd_kegiatan = $kegiatan[0];
		$Nama_kegiatan = $kegiatan[1];
		$Tgl_masuk_proposal = $_POST['Tgl_masuk_proposal'];
		$Tgl_pelaksanaan = $_POST['Tgl_pelaksanaan'];
		$Tempat_pelaksanaan = $_POST['Tempat_pelaksanaan'];
		$Tema_kegiatan = $_POST['Tema_kegiatan'];
		$Total_kegiatan = $_POST['Total_kegiatan'];
		$Bipeks_terprogram = $_POST['Bipeks_terprogram'];
		$Kd_kategori = $_POST['Kd_kategori'];



/** Memasukkan data fullname ke dalam tabel PelaksanaanSeminar**/
		$keg = mysqli_query($connection, "SELECT Kd_bipeks FROM kegiatan WHERE kegiatan.Kd_kegiatan = $Kd_kegiatan");
		$Kd_bipeks = mysqli_fetch_array($keg);
		$Kd_bipeks = $Kd_bipeks[0];
     mysqli_query($connection, "INSERT INTO proposal VALUES ('$No_proposal','$Nama_kegiatan','$Tgl_masuk_proposal',
	 '$Tgl_pelaksanaan','$Tempat_pelaksanaan','$Tema_kegiatan', '$Total_kegiatan','$Bipeks_terprogram','$Kd_kategori', '$Kd_kegiatan')");
	 mysqli_query($connection, "UPDATE dana_bipeks SET bipeks_sisa = bipeks_sisa - '$Bipeks_terprogram' WHERE Kd_bipeks='$Kd_bipeks'");

     header("location:proposal.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM proposal");
	 $Kd_kegiatanquery = mysqli_query ($connection, "SELECT kegiatan.* , dana_bipeks.* FROM kegiatan, dana_bipeks
													 WHERE kegiatan.Kd_bipeks = dana_bipeks.Kd_bipeks ORDER BY Kd_kegiatan ASC");
	 $Bipeks_terprogramquery = mysqli_query ($connection, "SELECT kegiatan.* , dana_bipeks.* FROM kegiatan, dana_bipeks
														   WHERE kegiatan.Kd_bipeks = dana_bipeks.Kd_bipeks ORDER BY Kd_kegiatan ASC");
	 $Kd_kategoriquery = mysqli_query ($connection, "SELECT * FROM kategorikegiatan ORDER BY Kd_kategori ASC");
	 /**$Kd_bipeksquery = mysqli_query ($connection, "SELECT * FROM dana_bipeks ORDER BY Kd_bipeks ASC");
	 /**$Kd_ORMAquery = mysqli_query ($connection, "SELECT * FROM orma ORDER BY Kd_ORMA ASC"); **/
?>

<?php include("adminmenu.php") ?>

<div class="templatemo-content-wrapper">
<div class="templatemo-content entri-form">
	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>Proposal</h1><br>
	</div>
<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="No_proposal">Nomor Proposal</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="No_proposal" name="No_proposal" placeholder="Nomor Tugas"
			  maxlength="30" required="">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_kegiatan">Nama Kegiatan</label>
			<div class="col-md-6 col-sm-6 col-xs-6">
			<select id="Kd_kegiatan" name="Kd_kegiatan" class="form-control">
			<option value="Kd_kegiatan">NULL</option>
			<?php if (mysqli_num_rows($Kd_kegiatanquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($Kd_kegiatanquery)) {?>
					<option value="<?php echo $row["Kd_kegiatan"]."^".$row["Nama_kegiatan"]; ?>">
						<?php echo $row["Kd_kegiatan"]?>
						<?php echo $row["Nama_kegiatan"]?>
						<?php echo $row["Kd_bipeks"]?>
						<?php echo $row["Kd_ORMA"]?>
					</option>
				<?php } ?>
			<?php } ?>

			</select>
			</div>
		  </div>

		  		 <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Bipeks_terprogram">Bipekstur Terprogram</label>
			<div class="col-md-6 col-sm-6 col-xs-6">
			<select id="Bipeks_terprogram" name="Bipeks_terprogram" class="form-control">
			<option value="Bipeks_terprogram">NULL</option>
			<?php if (mysqli_num_rows($Bipeks_terprogramquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($Bipeks_terprogramquery)) {?>
					<option>

						<?php echo $row["Bipeks_terprogram"]?>
						<?php echo $row["Nama_kegiatan"]?>
						<?php echo $row["Kd_ORMA"]?>


					</option>
				<?php } ?>
			<?php } ?>

			</select>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_kategori">Kode Kategori</label>
			<div class="col-md-6 col-sm-6 col-xs-6">
			<select id="Kd_kategori" name="Kd_kategori" class="form-control">
			<option value="Kd_kategori">NULL</option>
			<?php if (mysqli_num_rows($Kd_kategoriquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($Kd_kategoriquery)) {?>
					<option value="<?php echo $row["Kd_kategori"] ?>">
						<?php echo $row["Kd_kategori"]?>
						<?php echo $row["Nama_kategori"]?>
					</option>
				<?php } ?>
			<?php } ?>

			</select>
			</div>
		  </div>

		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tgl_masuk_proposal">Tanggal Masuk Proposal</label>
			<div class="col-sm-6">
			  <input class="form-control" type="date" id="Tgl_masuk_proposal" name="Tgl_masuk_proposal">
			</div>
		  </div>
		 <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tgl_pelaksanaan">Tanggal Pelaksanaan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="date" id="Tgl_pelaksanaan" name="Tgl_pelaksanaan">
			</div>
		  </div>

		 <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tempat_pelaksanaan">Tempat Pelaksanaan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tempat_pelaksanaan" name="Tempat_pelaksanaan" placeholder="Tempat Pelaksanaan">
			</div>
		  </div>

		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tema_kegiatan">Tema Kegiatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tema_kegiatan" name="Tema_kegiatan" placeholder="Tema Kegiatan">
			</div>
		  </div>

		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Total_kegiatan">Total Kegiatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Total_kegiatan" name="Total_kegiatan" placeholder="Total Kegiatan">
			</div>
		  </div>



		  <div class="col-sm-3">

		  </div>
		  <div class="col-sm-4">
			<input class="btn btn-lg btn-primary" type="submit" value="Simpan" name="Simpan">
			<!-- tombol diperbesar dg -lg dan berwarna biru dengan -primary -->
			<input class="btn btn-lg btn-info" type="reset" value="Batal"> <!-- tombol berwarna hijau langit -->
		  </div>
		</form>

	<table class="table table-hover">
		<div class="etri-form">
			<br><br><br><h1><b>HASIL ENTRI Proposal</b></h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Nomor Proposal</th>
				<th>Nama Kegiatan</th>
				<th>Tanggal Masuk Proposal</th>
				<th>Tanggal Pelaksanaan</th>
				<th>Tempat Pelaksanaan</th>
				<th>Tema Kegiatan</th>
				<th>Total Kegiatan</th>
				<th>Bipeks Terprogram</th>
				<th>Kode Kategori</th>
				<th>ACTION</th>
	</tr>
	<?php
		/** Memeriksa apakah data yang dipanggil tersebut tersedia atau tidak **/
		if(mysqli_num_rows($query)>0)
	{?>
		<?php $no=1; ?>
		<?php while ($row = mysqli_fetch_array($query))
			{ ?>
				<tr class="danger" height="20px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row['No_proposal']; ?> </td>
					<td><?php echo $row['Nama_kegiatan']; ?> </td>
					<?php $tgl = $row['Tgl_masuk_proposal']; ?>
					<?php $tgl = date('d M Y', strtotime($tgl)); ?>
					<td><?php echo $tgl; ?> </td>
					<?php $tgl = $row['Tgl_pelaksanaan']; ?>
					<?php $tgl = date('d M Y', strtotime($tgl)); ?>
					<td><?php echo $tgl; ?> </td>
					<td><?php echo $row['Tempat_pelaksanaan']; ?> </td>
					<td><?php echo $row['Tema_kegiatan']; ?> </td>
					<td><?php echo $row['Total_kegiatan']; ?> </td>
					<td><?php echo $row['Bipeks_terprogram']; ?> </td>
					<td><?php echo $row['Kd_kategori']; ?> </td>

					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="proposalubah.php?proposalubah=<?php echo $row["No_proposal"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i></a>
						<a href="proposalhapus.php?proposalhapus=<?php echo $row["No_proposal"]?>">   Delete</a>
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
	$(document).ready(function() {
		$("#Kd_kegiatan").select2({ placeholder: "Silahkan pilih" });
		$("#Bipeks_terprogram").select2({ placeholder: "Silahkan pilih" });
		$("#Kd_kategori").select2({ placeholder: "Silahkan pilih" });
		$("#Tgl_masuk_proposal").change(function() {
			var val = $(this).val();
			var split = val.split("-");
			var selected = new Date(split[0], split[1]-1, split[2]);
			selected.setMonth(selected.getMonth() + 1);
			var yr = selected.getFullYear(),
				mon = selected.getMonth()+1,
				day = selected.getDate() < 10 ? '0' + selected.getDate() : selected.getDate();
			mon = mon < 10 ? '0' + mon : mon;
			var newDate = yr + "-" + mon + "-" + day;
			$("#Tgl_pelaksanaan").val('').trigger("çhange");
			document.getElementById("Tgl_pelaksanaan").setAttribute("min", val);
			document.getElementById("Tgl_pelaksanaan").setAttribute("max", newDate);
		});
	});
</script>

<?php
mysqli_close($connection);
ob_end_flush();

?>

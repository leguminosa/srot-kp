
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {
		if (isset($_REQUEST["Kd_ORMA"]))
			{	$Kd_ORMA = $_REQUEST["Kd_ORMA"];
			}
		if (!empty($Kd_ORMA))
			{	$Kd_ORMA = $_POST['Kd_ORMA'];
			}
		$Nama_ORMA = $_POST['Nama_ORMA'];
		$NIM_ketua= $_POST['NIM_ketua'];
		$Id_unitkerja= $_POST['Id_unitkerja'];


/** Memasukkan data fullname ke dalam tabel universitas**/
     mysqli_query($connection, "INSERT INTO orma VALUES ('$Kd_ORMA',
	 '$Nama_ORMA','$NIM_ketua','$Id_unitkerja')");
     header("location:orma.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM orma");
	 $Id_unitkerjaquery = mysqli_query ($connection, "SELECT * FROM unitkerja ORDER BY Id_unitkerja ASC");

?>

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>Organisasi Mahasiswa</h1><br>

	</div>

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_ORMA">Kode Organisasi</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Kd_ORMA" name="Kd_ORMA" placeholder="Kode Organisasi"
			  maxlength="10" required="">
			</div>
		  </div>

		  	 <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Id_unitkerja">Unit Kerja</label>
			<div class="col-md-6 col-sm-6 col-xs-6">
            <select id="Id_unitkerja" name="Id_unitkerja" class="form-control">
			<option value="Id_unitkerja">NULL</option>
			<?php if (mysqli_num_rows($Id_unitkerjaquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($Id_unitkerjaquery)) {?>
					<option>
						<?php echo $row["Id_unitkerja"]?>
						<?php echo $row["Nama_unitkerja"]?>

					</option>
				<?php } ?>
			<?php } ?>

			</select>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_ORMA">Nama Organisasi</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_ORMA" name="Nama_ORMA" placeholder="Nama Organisasi">
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
			<br><br><br><h1><b>HASIL ENTRI ORGANISASI MAHASISWA</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Kode Organisasi</th>
				<th>Nama Organisasi</th>
				<th>Unit Kerja</th>
				<th>Action</th>

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
					<td><?php echo $row['Kd_ORMA']; ?> </td>
					<td><?php echo $row['Nama_ORMA']; ?> </td>
					<td><?php echo $row['Id_unitkerja']; ?> </td>

					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="ormaubah.php?ormaubah=<?php echo $row["Kd_ORMA"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="ormahapus.php?ormahapus=<?php echo $row["Kd_ORMA"]?>">   Delete</a>
					</td>
				</tr>
				<?php $no++; ?>
			<?php  } ?>
	<?php  } ?>
	</table>
	</div>
</div>


<?php include("adminfooter.php") ?>

<script>

$("#Id_unitkerja").select2({ placeholder: "Silahkan pilih" });
</script>

<?php
mysqli_close($connection);
ob_end_flush();

?>

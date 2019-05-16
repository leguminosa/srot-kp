
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {
		if (isset($_REQUEST["Kd_KetuaORMA"]))
			{	$Kd_KetuaORMA = $_REQUEST["Kd_KetuaORMA"];
			}
		if (!empty($Kd_KetuaORMA))
			{	$Kd_KetuaORMA = $_POST['Kd_KetuaORMA'];
			}
		$Nama_KetuaORMA = $_POST['Nama_KetuaORMA'];
		$NIM= $_POST['NIM'];
		$Periode_KetuaORMA= $_POST['Periode_KetuaORMA'];
		$Kd_ORMA= $_POST['Kd_ORMA'];


/** Memasukkan data fullname ke dalam tabel universitas**/
     mysqli_query($connection, "INSERT INTO detail_ketuaorma VALUES ('$Kd_KetuaORMA',
	 '$Nama_KetuaORMA','$NIM','$Periode_KetuaORMA','$Kd_ORMA')");
     header("location:detailorma.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM detail_ketuaorma");
	 $Kd_ORMAquery = mysqli_query ($connection, "SELECT * FROM orma ORDER BY Kd_ORMA ASC");

?>

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>Detail Organisasi Mahasiswa</h1><br>

	</div>

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_KetuaORMA">Kode Ketua Organisasi</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Kd_KetuaORMA" name="Kd_KetuaORMA" placeholder="Kode Ketua Organisasi"
			  maxlength="10" required="">
			</div>
		  </div>

		  	<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_ORMA">Kode ORMA</label>
            <div class="col-md-6 col-sm-6 col-xs-6">
            <select id="Kd_ORMA" name="Kd_ORMA" class="form-control">
			<option value="Kd_ORMA">NULL</option>
			<?php if (mysqli_num_rows($Kd_ORMAquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($Kd_ORMAquery)) {?>
					<option>
						<?php echo $row["Kd_ORMA"]?>
						<?php echo $row["Nama_ORMA"]?>
					</option>
				<?php } ?>
			<?php } ?>

			</select>
			</div>
			</div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_KetuaORMA">Nama Ketua Organisasi</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_KetuaORMA" name="Nama_KetuaORMA" placeholder="Nama Ketua Organisasi">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="NIM">NIM</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="NIM" name="NIM" placeholder="NIM Ketua"
			  pattern=".{9,9}" maxlength="9" required title="harus 8 angka" required="" >
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Periode_KetuaORMA">Periode Ketua</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Periode_KetuaORMA" name="Periode_KetuaORMA" placeholder="Periode Ketua ORMA">
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
			<br><br><br><h1><b>HASIL ENTRI DETAIL ORGANISASI MAHASISWA</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Kode Ketua Organisasi</th>
				<th>Nama Ketua Organisasi</th>
				<th>NIM Ketua</th>
				<th>Periode Ketua</th>
				<th>Kode ORMA</th>
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
					<td><?php echo $row['Kd_KetuaORMA']; ?> </td>
					<td><?php echo $row['Nama_KetuaORMA']; ?> </td>
					<td><?php echo $row['NIM']; ?> </td>
					<td><?php echo $row['Periode_KetuaORMA']; ?> </td>
					<td><?php echo $row['Kd_ORMA']; ?> </td>

					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="detailormaubah.php?detailormaubah=<?php echo $row["Kd_KetuaORMA"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="detailormahapus.php?detailormahapus=<?php echo $row["Kd_KetuaORMA"]?>">   Delete</a>
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

$("#Kd_ORMA").select2({ placeholder: "Silahkan pilih" });
</script>

<?php
mysqli_close($connection);
ob_end_flush();

?>

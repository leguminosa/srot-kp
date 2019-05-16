
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
    if(isset($_POST['Simpan'])) {
		if (isset($_REQUEST["Kd_detailLPJ"]))
			{	$Kd_detailLPJ = $_REQUEST["Kd_detailLPJ"];
			}
		if (!empty($Kd_detailLPJ))
			{	$Kd_detailLPJ = $_POST['Kd_detailLPJ'];
			}
		$Nama_detailLPJ = $_POST['Nama_detailLPJ'];
		$Keterangan_detailLPJ= $_POST['Keterangan_detailLPJ'];
		$Nominal= $_POST['Nominal'];
		$No_LPJ = $_POST['No_LPJ'];



/** Memasukkan data fullname ke dalam tabel universitas**/
		$insert = "INSERT INTO detaillpj VALUES (NULL,'$Nama_detailLPJ','$Keterangan_detailLPJ', '$Nominal', '$No_LPJ')";
		// print_r($insert); die();
		mysqli_query($connection, $insert);
		if($Keterangan_detailLPJ == 'Pemasukan') {
			$masuk = "UPDATE lpj SET Total_Pemasukan = Total_Pemasukan + '$Nominal' WHERE No_LPJ = '$No_LPJ'";
			mysqli_query($connection, $masuk);
		} else if($Keterangan_detailLPJ == 'Pengeluaran') {
			$keluar = "UPDATE lpj SET Total_Pengeluaran = Total_Pengeluaran + '$Nominal' WHERE No_LPJ = '$No_LPJ'";
			mysqli_query($connection, $keluar);
		}
		$sisa = "UPDATE lpj SET Sisa_selisih = Total_Pemasukan - Total_Pengeluaran WHERE No_LPJ = '$No_LPJ'";
		mysqli_query($connection, $sisa);

		header("location:detailLpj.php");
    }

	$query = mysqli_query($connection, "SELECT * FROM detaillpj");
	$No_lpjquery = mysqli_query ($connection, "SELECT * FROM lpj ORDER BY No_LPJ ASC");
?>

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>Detail LPJ</h1><br>

	</div>

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		 <!--<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_detailLPJ">Kode Detail</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Kd_detailLPJ" name="Kd_detailLPJ" placeholder="Kode Detail LPJ"
			  maxlength="8" required="" required="">
			</div>
		  </div>!-->

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="No_LPJ">Nomor LPJ</label>
            <div class="col-md-6 col-sm-6 col-xs-6">
            <select id="No_LPJ" name="No_LPJ" class="form-control">
			<option value="No_LPJ">NULL</option>
			<?php if (mysqli_num_rows($No_lpjquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($No_lpjquery)) {?>
					<option>
						<?php echo $row["No_LPJ"]?>
					</option>
				<?php } ?>
			<?php } ?>

			</select>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_detailLPJ">Detail LPJ</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_detailLPJ" name="Nama_detailLPJ" placeholder="Detail LPJ">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Keterangan_detailLPJ">Keterangan</label>
			<div class="col-sm-6">
			  <input type="radio" value="Pemasukan" name="Keterangan_detailLPJ" checked> Pemasukan
			  <input type="radio" value="Pengeluaran" name="Keterangan_detailLPJ"> Pengeluaran
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nominal">Nominal</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nominal" name="Nominal" placeholder="Nominal">
			</div>
		  </div>





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
			<br><br><br><h1><b>HASIL ENTRI DETAIL LPJ</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>KODE</th>
				<th>NO LPJ</th>
				<th>NAMA</th>
				<th>KETERANGAN</th>
				<th>NOMINAL</th>
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
					<td><?php echo $row['Kd_detailLPJ']; ?> </td>
					<td><?php echo $row['No_LPJ']; ?> </td>
					<td><?php echo $row['Nama_detailLPJ']; ?> </td>
					<td><?php echo $row['Keterangan_detailLPJ']; ?> </td>
					<td><?php echo $row['Nominal']; ?> </td>



					<td>
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="detailLpjhapus.php?detailLpjhapus=<?php echo $row["Kd_detailLPJ"]?>">   Delete</a>
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

$("#No_LPJ").select2({ placeholder: "Silahkan pilih" });
</script>

<?php
mysqli_close($connection);
ob_end_flush();

?>

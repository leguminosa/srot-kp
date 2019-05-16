
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {
		if (isset($_REQUEST["No_LPJ"]))
			{	$No_LPJ = $_REQUEST["No_LPJ"];
			}
		if (!empty($No_LPJ))
			{	$No_LPJ = $_POST['No_LPJ'];
			}
		$Tgl_penerimaanLPJ = $_POST['Tgl_penerimaanLPJ'];
		$Total_pemasukan= 0;
		$Total_pengeluaran= 0;
		$Sisa_selisih= 0;
		$Keterangan_sisaselisih= $_POST['Keterangan_sisaselisih'];
	$nama = $_FILES['file']['name']; /** untuk menampung data foto atau gambar **/
	$file_tmp = $_FILES["file"]["tmp_name"];
	move_uploaded_file($file_tmp, 'images/iconkabupaten/'.$nama); /** untuk upload file gambarnya **/
		$No_SIK= $_POST['No_SIK'];


/** Memasukkan data fullname ke dalam tabel universitas**/
     mysqli_query($connection, "INSERT INTO lpj VALUES ('$No_LPJ',
	 '$Total_pemasukan','$Total_pengeluaran','$Sisa_selisih','$Tgl_penerimaanLPJ','$Keterangan_sisaselisih','$$nama','$No_SIK')");
     header("location:lpj.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM lpj");
	 $No_sikquery = mysqli_query ($connection, "SELECT * FROM sik ORDER BY No_SIK ASC");

?>

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>Laporan Penanggungjawaban</h1><br>

	</div>

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="No_LPJ">Nomor LPJ</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="No_LPJ" name="No_LPJ" placeholder="No LPJ"
			  maxlength="10" required="">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tgl_penerimaanLPJ">Tanggal Pelaksanaan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="date" id="Tgl_penerimaanLPJ" name="Tgl_penerimaanLPJ" placeholder="Tanggal Pelaksanaan">
			</div>
		  </div>

		 <!-- <div class="form-group form-group-lg" >
			<label class="col-sm-3 control-label"  for="Total_pemasukan"> Total Pemasukan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Total_pemasukan" name="Total_pemasukan" placeholder="Total Pemasukan">

			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Total_pengeluaran">Total Pengeluaran</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Total_pengeluaran" name="Total_pengeluaran" placeholder="Total Pengeluaran">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Sisa_selisih">Sisa Selisih</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Sisa_selisih" name="Sisa_selisih" placeholder="Sisa Selisih">
			</div>
		  </div> -->

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Keterangan_sisaselisih">Keterangan Sisa selisih</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Keterangan_sisaselisih" name="Keterangan_sisaselisih" placeholder="Keterangan Sisa Selisih">
			</div>
		  </div>

		  <div class="form-group form-group">
			<label class="col-sm-3 control-label" for="file">Scan LPJ</label>
			<div class="col-sm-9">
			  <input type="file" id="file" name="file">
			  <p class="help-block">Field ini digunakan untuk mengambil file gambar/foto ICON berita</p>
			</div>
		  </div>

		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="No_SIK">Nomor SIK</label>
            <div class="col-md-2 col-sm-2 col-xs-2">
            <select id="No_SIK" name="No_SIK" class="form-control">
			<option value="No_SIK">NULL</option>
			<?php if (mysqli_num_rows($No_sikquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($No_sikquery)) {?>
					<option>
						<?php echo $row["No_SIK"]?>
						<?php echo $row["Tgl_SIK"]?>

					</option>
				<?php } ?>
			<?php } ?>

			</select>
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
			<br><br><br><h1><b>HASIL ENTRI LAPORAN PENANGGUNGJAWABAN</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Nomor LPJ</th>
				<th>Tanggal Penerimaan LPJ</th>
				<th>Total Pemasukan</th>
				<th>Total Pengeluaran</th>
				<th>Sisa Selisih</th>
				<th>Keterangan Sisa Selisih</th>
				<th>Scan</th>
				<th>Nomor SIK</th>
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
					<td><?php echo $row['No_LPJ']; ?> </td>
					<?php $tgl = $row['Tgl_penerimaanLPJ']; ?>
					<?php $tgl = date('d M Y', strtotime($tgl)); ?>
					<td><?php echo $tgl; ?> </td>
					<td><?php echo $row['Total_Pemasukan']; ?> </td>
					<td><?php echo $row['Total_Pengeluaran']; ?> </td>
					<td><?php echo $row['Sisa_selisih']; ?> </td>
					<td><?php echo $row['Keterangan_sisaselisih']; ?> </td>

					<td>
						<?php if($row['scan']==""){ echo "<img src='images/noimage.png' width='88'/>";}else{?>
						<img src="images/poster/<?php echo $row['scan'] ?>" width="88" class="img-responsive" />
						<?php }?>
					</td>

					<td><?php echo $row['No_SIK']; ?> </td>

					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="lpjprint.php?lpjprint=<?php echo $row["No_LPJ"]?>">   Print</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="lpjhapus.php?lpjhapus=<?php echo $row["No_LPJ"]?>">   Delete</a>
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

$("#No_SIK").select2({ placeholder: "Silahkan pilih" });
</script>

<?php
mysqli_close($connection);
ob_end_flush();

?>

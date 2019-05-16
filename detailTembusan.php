
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan'])) {
		if (isset($_REQUEST["Kd_Tembusan"]))
			{	$Kd_Tembusan = $_REQUEST["Kd_Tembusan"];
			}
		if (!empty($Kd_Tembusan))
			{	$Kd_Tembusan = $_POST['Kd_Tembusan'];
			}
		// $Nama_Tembusan = $_POST['Nama_Tembusan'];
		$No_SIK = $_POST['No_SIK'];

/** Memasukkan data fullname ke dalam tabel universitas**/
        $query = "INSERT INTO sik_tembusan VALUES (NULL, '$No_SIK', '$Kd_Tembusan')";
        // print_r($query);
        mysqli_query($connection, $query);
        header("location:detailTembusan.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM tembusan, sik_tembusan WHERE tembusan.Kd_Tembusan = sik_tembusan.Kd_Tembusan");
  $No_SIKquery = mysqli_query ($connection, "SELECT * FROM sik ORDER BY No_SIK ASC");
   $tembusan_query = mysqli_query ($connection, "SELECT * FROM tembusan");
?>

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>Detail Tembusan</h1><br>

	</div>

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <!--<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_Tembusan">Kd Tembusan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Kd_Tembusan" name="Kd_Tembusan" placeholder="Kode Tembusan"
			  maxlength="3" required="">
			</div>
		  </div> !-->

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_Tembusan">Nama Tembusan</label>
			<div class="col-md-6 col-sm-6 col-xs-6">
            <select id="Kd_Tembusan" name="Kd_Tembusan" class="form-control">
			<option value="">NULL</option>
			<?php if (mysqli_num_rows($tembusan_query)> 0) {?>
				<?php while ($row=mysqli_fetch_array($tembusan_query)) {?>
					<option value="<?php echo $row["Kd_Tembusan"]; ?>">
						<?php echo $row["Nama_Tembusan"]?>
					</option>
				<?php } ?>
			<?php } ?>
			</select>
			</div>
		  </div>

		  	<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="No_proposal">Nomor SIK</label>
			<div class="col-md-6 col-sm-6 col-xs-6">
            <select id="No_SIK" name="No_SIK" class="form-control">
			<option value="">NULL</option>
			<?php if (mysqli_num_rows($No_SIKquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($No_SIKquery)) {?>
					<option value="<?php echo $row["No_SIK"]?>">

						<?php echo $row["No_SIK"]?>
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
			<br><br><br><h1><b>HASIL ENTRI DETAIL TEMBUSAN</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>No</th>
				<th>Kode Tembusan</th>
				<th>Nama Tembusan</th>
				<th>No SIK</th>
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
					<td><?php echo $row['Kd_Tembusan']; ?> </td>
					<td><?php echo $row['Nama_Tembusan']; ?> </td>
					<td><?php echo $row['No_SIK']; ?> </td>

					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="detailTembusanhapus.php?detailTembusanhapus=<?php echo $row["id"]?>">   Delete</a>
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

$("#Kd_Tembusan").select2({ placeholder: "Silahkan pilih" });
$("#No_SIK").select2({ placeholder: "Silahkan pilih" });
</script>

<?php
mysqli_close($connection);
ob_end_flush();

?>


<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {
		if (isset($_REQUEST["No_SIK"]))
			{	$No_SIK = $_REQUEST["No_SIK"];
			}
		if (!empty($No_SIK))
			{	$No_SIK = $_POST['No_SIK'];
			}
		$Tgl_SIK = $_POST['Tgl_SIK'];
		$Perihal= $_POST['Perihal'];
		$No_proposal= $_POST['No_proposal'];


/** Memasukkan data fullname ke dalam tabel universitas**/
     mysqli_query($connection, "INSERT INTO sik VALUES ('$No_SIK',
	 '$Tgl_SIK','$Perihal','$No_proposal')");
     header("location:sik.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM sik");
	 $No_proposalquery = mysqli_query ($connection, "SELECT * FROM proposal ORDER BY No_proposal ASC");


?>



<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>Surat Izin Kegiatan</h1><br>

	</div>

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="No_SIK">Nomor SIK</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="No_SIK" name="No_SIK" placeholder="Nomor SIK"
			  maxlength="33" required="">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tgl_SIK">Tanggal SIK</label>
			<div class="col-sm-6">
			  <input class="form-control" type="date" id="Tgl_SIK" name="Tgl_SIK" placeholder="Tanggal SIK">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Perihal">Perihal</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Perihal" name="Perihal" placeholder="Perihal">
			</div>
		  </div>

			   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="No_proposal">Nomor Proposal</label>
			<div class="col-md-2 col-sm-2 col-xs-2">
            <select id="No_proposal" name="No_proposal" class="form-control">
			<option value="No_proposal">NULL</option>
			<?php if (mysqli_num_rows($No_proposalquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($No_proposalquery)) {?>
					<option>
						<?php echo $row["No_proposal"]?>
						<?php echo $row["Tgl_masuk_proposal"]?>


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
			<br><br><br><h1><b>HASIL ENTRI SURAT IZIN KEGIATAN</h1>
		</div>

		<div>
           <!-- <form class="navbar-form navbar-right" action="siklaporan.php" method="POST">
                <div class="form-group">
                    <!-- <div class="col-lg-8 col-lg-8 col-lg-8 col-lg-8"></div> -->
                 <!--   <div class="col-lg-4 col-lg-4 col-lg-4 col-lg-4" style="float:right;">
                        <input type="text" class="form-control" name="Kd_ORMA" placeholder="Search Tahun Akad">
                    </div>
                </div>
			<!--	<button type="submit" value="cari" class="btn btn-default" style="float:right;">Submit</button>
				<!-- <a href="printhome.php" style="float:right;">Print</a> -->
			</form>
        </div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Nomor SIK</th>
				<th>Tanggal SIK</th>
				<th>Perihal</th>
				<th>Nomor Proposal</th>
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
					<td><?php echo $row['No_SIK']; ?> </td>
<?php $tgl = $row['Tgl_SIK']; ?>
<?php $tgl = date('d M Y', strtotime($tgl)); ?>
					<td><?php echo $tgl; ?> </td>
					<td><?php echo $row['Perihal']; ?> </td>
					<td><?php echo $row['No_proposal']; ?> </td>


					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="sikprint.php?sikprint=<?php echo $row["No_SIK"]?>">   Print</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="sikhapus.php?sikhapus=<?php echo $row["No_SIK"]?>">   Delete</a>
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

$("#No_proposal").select2({ placeholder: "Silahkan pilih" });
</script>

<?php
mysqli_close($connection);
ob_end_flush();

?>

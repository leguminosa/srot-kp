
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$Kd_ORMA = $_GET['ormaubah'];
		$Nama_ORMA = $_POST['Nama_ORMA'];
		$Nama_ketua= $_POST['Nama_ketua'];
		$NIM_ketua= $_POST['NIM_ketua'];
		$Periode_ketua= $_POST['Periode_ketua'];
		$Id_unitkerja= $_POST['Id_unitkerja'];

        $update = "UPDATE orma SET Nama_ORMA = '$Nama_ORMA',
		Nama_ketua = '$Nama_ketua', NIM_ketua = '$NIM_ketua', Periode_ketua = '$Periode_ketua',
		Id_unitkerja = '$Id_unitkerja'
		 WHERE Kd_ORMA='$Kd_ORMA'";
         // print_r($update); die();
		mysqli_query($connection, $update);

		header("location:orma.php");
}

$Kd_ORMA = $_GET["ormaubah"] ;
$edit = mysqli_query($connection, "SELECT * FROM orma WHERE Kd_ORMA = '$Kd_ORMA'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM orma");

?>

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>Organisasi Mahasiswa Ubah</h1><br>

	</div>

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_ORMA">Nama Organisasi</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_ORMA" name="Nama_ORMA"
			  value = "<?php echo $row_edit['Nama_ORMA']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_ketua">Nama Ketua Organisasi</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_ketua" name="Nama_ketua"
			  value = "<?php echo $row_edit['Nama_ketua']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="NIM_ketua">NIM</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="NIM_ketua" name="NIM_ketua"
			  pattern=".{9,9}" maxlength="9" required title="harus 8 angka" value = "<?php echo $row_edit['NIM_ketua']?>"/>
			</div>
		  </div>

		 <div class="form-group form-group-lg">
			<!-- <label class="col-sm-3 control-label" for="Periode_ketua">Periode Ketua</label> -->
			<div class="col-sm-6">
			  <input type="hidden" class="form-control" type="text" id="Periode_ketua" name="Periode_ketua"
			  value = "<?php echo $row_edit['Periode_ketua']?>"/>
              <input type="hidden" name="Id_unitkerja" value="<?php echo $row_edit['Id_unitkerja']; ?>"/>
			</div>
		  </div>


		  <div class="col-sm-3">

		  </div>
		 <div class="col-sm-4">
			<input class="btn btn-lg btn-primary" type="submit" value="Update" name="Update">
			<!-- tombol diperbesar dg -lg dan berwarna biru dengan -primary -->
			<input class="btn btn-lg btn-info" type="reset" value="Batal"> <!-- tombol berwarna hijau langit -->
		  </div>
		</form>

	<table class="table table-hover">
		<div class="etri-form">
			<br><br><br><h1><b>HASIL ENTRI ORMA</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Kode Organisasi Mahasiswa</th>
				<th>Nama Organisasi Mahasiswa</th>
				<th>Nama Ketua</th>
				<th>NIM Ketua</th>
				<th>PERIODE KETUA</th>
				<th>ID UNIT KERJA</th>


				</tr>
	<?php
		/** Memeriksa apakah data yang dipanggil tersebut tersedia atau tidak **/
		if(mysqli_num_rows($query)>0)
	{?>
		<?php $no=1; ?>
		<?php while ($row = mysqli_fetch_array($query))
			{ ?>
				<tr class="danger" height="0px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row['Kd_ORMA']; ?> </td>
					<td><?php echo $row['Nama_ORMA']; ?> </td>
					<td><?php echo $row['Nama_ketua']; ?> </td>
					<td><?php echo $row['NIM_ketua']; ?> </td>
					<td><?php echo $row['Periode_ketua']; ?> </td>
					<td><?php echo $row['Id_unitkerja']; ?> </td>




					<td>

					</td>
				</tr>
				<?php $no++; ?>
			<?php  } ?>
	<?php  } ?>
	</table>
	</div>
</div>

<?php include("adminfooter.php") ?>


<?php
mysqli_close($connection);
ob_end_flush();

?>

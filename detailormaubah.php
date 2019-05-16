
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$Kd_KetuaORMA = $_GET['detailormaubah'];
		$Nama_KetuaORMA = $_POST['Nama_KetuaORMA'];
		$NIM= $_POST['NIM'];
		$Periode_KetuaORMA= $_POST['Periode_KetuaORMA'];
		$Kd_ORMA= $_POST['Kd_ORMA'];

        $update = "UPDATE detailorma SET Nama_KetuaORMA = '$Nama_KetuaORMA',
		NIM = '$NIM', Periode_KetuaORMA = '$Periode_KetuaORMA', Kd_ORMA = '$Kd_ORMA'
		 WHERE Kd_KetuaORMA='$Kd_KetuaORMA'";
         // print_r($update); die();
		mysqli_query($connection, $update);

		header("location:detailorma.php");
}

$Kd_KetuaORMA = $_GET["detailormaubah"] ;
$edit = mysqli_query($connection, "SELECT * FROM detail_ketuaorma WHERE Kd_KetuaORMA = '$Kd_KetuaORMA'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM detail_ketuaorma");

?>

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>Detail Organisasi Mahasiswa Ubah</h1><br>

	</div>

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_KetuaORMA">Nama Ketua Organisasi</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_KetuaORMA" name="Nama_KetuaORMA"
			  value = "<?php echo $row_edit['Nama_KetuaORMA']?>"/>
			</div>
		  </div>

		 	<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="NIM">NIM</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="NIM" name="NIM" placeholder="NIM Ketua"
			value = "<?php echo $row_edit['NIM']?>"			  
			pattern=".{9,9}" maxlength="9" required title="harus 8 angka" required="" >
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Periode_KetuaORMA">Periode Ketua</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Periode_KetuaORMA" name="Periode_KetuaORMA" placeholder="Periode Ketua ORMA"
			  value = "<?php echo $row_edit['Periode_KetuaORMA']?>"
			</div>
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
				<tr class="danger" height="0px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row['Kd_KetuaORMA']; ?> </td>
					<td><?php echo $row['Nama_KetuaORMA']; ?> </td>
					<td><?php echo $row['NIM']; ?> </td>
					<td><?php echo $row['Periode_KetuaORMA']; ?> </td>
					<td><?php echo $row['Kd_ORMA']; ?> </td> 




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

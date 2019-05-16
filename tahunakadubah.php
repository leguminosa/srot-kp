 
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$Periode_th_akad = $_POST['Periode_th_akad'];
		$Keterangan = $_POST['Keterangan'];
		/**$Jabatan= $_POST['Jabatan'];
		$Email= $_POST['Email'];
		$Password= $_POST['Password'];**/
				
		mysqli_query($connection, "UPDATE th_akad SET Keterangan='$Keterangan' WHERE Periode_th_akad='$Periode_th_akad'"); 
		header("location:tahunakad.php");
}

$Periode_th_akad = $_GET["tahunakadubah"] ;
$edit = mysqli_query($connection, "SELECT * FROM th_akad WHERE Periode_th_akad = '$Periode_th_akad'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM th_akad");
 
?>	

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>Tahun Akad Ubah</h1><br>
		
	</div>			

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Periode_th_akad">Periode</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Periode_th_akad" name="Periode_th_akad" 
			  value = "<?php echo $row_edit['Periode_th_akad']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Keterangan">Keterangan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Keterangan" name="Keterangan" 
			  value = "<?php echo $row_edit['Keterangan']?>"/>
			</div>
		  </div>

	<!--	  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Jabatan">Jabatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Jabatan" name="Jabatan" placeholder="Nama Belakang">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Email">Email</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Email" name="Email" placeholder="Email">
			</div>
		  </div>
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Password">Password</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Password" name="Password" placeholder="Password">
			</div>
		  </div> -->

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
			<br><br><br><h1><b>HASIL ENTRI PERIODE TAHUN AKAD</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>PERIODE TAHUN AKAD</th>
				<th>KETERANGAN</th>
				
				
					
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
					<td><?php echo $row['Periode_th_akad']; ?> </td>
					<td><?php echo $row['Keterangan']; ?> </td>
				<!--	<td><?php echo $row['Jabatan']; ?> </td>
					<td><?php echo $row['Email']; ?> </td>
								
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="tahunakadubah.php?tahunakadubah=<?php echo $row["Id_admin"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="pengelola1hapus.php?pengelola1hapus=<?php echo $row["Id_admin"]?>">   Delete</a> 
					</td> -->
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

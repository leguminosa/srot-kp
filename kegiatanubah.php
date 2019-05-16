 
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$Kd_kegiatan = $_POST['Kd_kegiatan'];
		$Nama_kegiatan = $_POST['Nama_kegiatan'];
		$Waktu_pelaksanaan= $_POST['Waktu_pelaksanaan'];
		$Ketua_pelaksana= $_POST['Ketua_pelaksana'];
		$Bipeks_terprogram= $_POST['Bipeks_terprogram'];
		$Kd_Bipeks= $_POST['Kd_Bipeks'];
				
		mysqli_query($connection, "UPDATE admin SET Nama_kegiatan='$Nama_kegiatan',Waktu_pelaksanaan='$Waktu_pelaksanaan',
		Ketua_pelaksana='$Ketua_pelaksana',Bipeks_terprogram='$Bipeks_terprogram', Kd_Bipeks='$Kd_Bipeks' WHERE Kd_kegiatan='$Kd_kegiatan'"); 
		header("location:kegiatan.php");
}

$Kd_kegiatan = $_GET["kegiatanubah"] ;
$edit = mysqli_query($connection, "SELECT * FROM kegiatan WHERE Kd_kegiatan = '$Kd_kegiatan'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM kegiatan");
 
?>	

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>Kegiatan Ubah</h1><br>
		
	</div>			

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_kegiatan">Kode Kegiatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Kd_kegiatan" name="Kd_kegiatan" 
			  value = "<?php echo $row_edit['Kd_kegiatan']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_kegiatan">Nama Kegiatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_kegiatan" name="Nama_kegiatan" placeholder="Nama Kegiatan"
			  value = "<?php echo $row_edit['Nama_kegiatan']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Waktu_pelaksanaan">Waktu Pelaksanan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Waktu_pelaksanaan" name="Waktu_pelaksanaan" placeholder="Waktu Pelaksanaan"
			  value = "<?php echo $row_edit['Waktu_pelaksanaan']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Ketua_pelaksana">Ketua Pelaksana</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Ketua_pelaksana" name="Ketua_pelaksana" placeholder="Ketua Pelaksana"
			  value = "<?php echo $row_edit['Ketua_pelaksana']?>"/>
			</div>
		  </div>
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Bipeks_terprogram">Bipekstur Terprogram</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Bipeks_terprogram" name="Bipeks_terprogram" placeholder="Bipek Terprogram"
			  value = "<?php echo $row_edit['Bipeks_terprogram']?>"/>
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
			<br><br><br><h1><b>HASIL ENTRI PROKER</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>KODE KEGIATAN</th>
				<th>NAMA KEGIATAN</th>
				<th>WAKTU PELAKSANAAN</th>
				<th>KETUA PELAKSANA</th>
				<th>BIPEKSTUR TERPROGRAM</th>
				
					
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
					<td><?php echo $row['Kd_kegiatan']; ?> </td>
					<td><?php echo $row['Nama_kegiatan']; ?> </td>
					<td><?php echo $row['Waktu_pelaksanaan']; ?> </td>
					<td><?php echo $row['Ketua_pelaksana']; ?> </td>
					<td><?php echo $row['Bipeks_terprogram']; ?> </td>
							
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="kegiatanubah.php?kegiatanubah=<?php echo $row["Kd_kegiatan"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="kegiatanhapus.php?kegiatanhapus=<?php echo $row["Kd_kegiatan"]?>">   Delete</a> 
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

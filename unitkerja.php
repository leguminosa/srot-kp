 
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {	
		if (isset($_REQUEST["Id_unitkerja"]))
			{	$Id_unitkerja = $_REQUEST["Id_unitkerja"];
			} 
		if (!empty($Id_unitkerja))
			{	$Id_unitkerja = $_POST['Id_unitkerja'];	
			}
		$Nama_unitkerja = $_POST['Nama_unitkerja'];
		$Keterangan = $_POST['Keterangan'];
		
/** Memasukkan data fullname ke dalam tabel universitas**/
     mysqli_query($connection, "INSERT INTO unitkerja VALUES ('$Id_unitkerja',
	 '$Nama_unitkerja', '$Keterangan')"); 
     header("location:unitkerja.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM unitkerja");
 
?>	

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>Unit Kerja</h1><br>
		
	</div>			

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
			<!-- <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Id_unitkerja">Id Unit Kerja</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Id_unitkerja" name="Id_unitkerja" placeholder="Unit Kerja" 
			  maxlength="4" required="">
			</div>
		  </div> !-->

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_unitkerja">Nama Unit Kerja</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_unitkerja" name="Nama_unitkerja" placeholder="Nama Unit Kerja">
			</div>
		  </div>

		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Keterangan">Keterangan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Keterangan" name="Keterangan" placeholder="Keterangan">
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
			<br><br><br><h1><b>HASIL ENTRI UNIT KERJA</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>No</th>
				<th>Id Unit Kerja</th>
				<th>Nama Unit Kerja</th>
				<th>Keterangan</th>
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
					<td><?php echo $row['Id_unitkerja']; ?> </td>
					<td><?php echo $row['Nama_unitkerja']; ?> </td>
					<td><?php echo $row['Keterangan']; ?> </td>
								
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="unitkerjaubah.php?unitkerjaubah=<?php echo $row["Id_unitkerja"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="unitkerjahapus.php?unitkerjahapus=<?php echo $row["Id_unitkerja"]?>">   Delete</a> 
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

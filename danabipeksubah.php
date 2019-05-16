
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Update']))
 	 {	
		$Kd_bipeks = $_POST['Kd_bipeks'];
		$Bipeks_total = $_POST['Bipeks_total'];
		$Periode_th_akad = $_POST['Periode_th_akad'];
		$Kd_ORMA = $_POST['Kd_ORMA'];
		
	
		
/** Memasukkan data fullname ke dalam tabel PelaksanaanSeminar**/
     mysqli_query($connection, "UPDATE dana_bipeks SET Bipeks_total='$Bipeks_total',
	 Periode_th_akad='$Periode_th_akad',Kd_ORMA='$Kd_ORMA' WHERE Kd_bipeks='$Kd_bipeks'"); 
     header("location:danabipeks.php");
     }
	 
	$Kd_bipeks = $_GET["danabipeksubah"] ;
	$edit = mysqli_query($connection, "SELECT * FROM dana_bipeks WHERE Kd_bipeks = '$Kd_bipeks'");
	$row_edit = mysqli_fetch_array($edit);

	 $query = mysqli_query($connection, "SELECT * FROM dana_bipeks");
	 $Periode_th_akadquery = mysqli_query ($connection, "SELECT * FROM th_akad ORDER BY Periode_th_akad ASC");
	 $Kd_ORMAquery = mysqli_query ($connection, "SELECT * FROM orma ORDER BY Kd_ORMA ASC");
?>	

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>Dana Bipekskur Ubah</h1><br>
	</div>	
<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_bipeks">Kode Bipekstur</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Kd_bipeks" name="Kd_bipeks" 
			  value = "<?php echo $row_edit['Kd_bipeks']?>"/>
			</div>
		  </div>
		  
		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Bipeks_total">Bipekstur Total</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Bipeks_total" name="Bipeks_total" placeholder="Bipekstur Total"
			  >
			</div>
		  </div>
			  
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Periode_th_akad">Periode Tahun Akad</label>
			<div class="col-sm-2">
			<select name="Periode_th_akad" class="form-control">
			<option value="Periode_th_akad">NULL</option>
			<?php if (mysqli_num_rows($Periode_th_akadquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($Periode_th_akadquery)) {?>
					<option> 
						<?php echo $row["Periode_th_akad"]?>
						
					</option>
				<?php } ?>
			<?php } ?>
			
			</select>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_ORMA">Kode Orma</label>
			<div class="col-sm-2">
			<select name="Kd_ORMA" class="form-control">
			<option value="Kd_ORMA">NULL</option>
			<?php if (mysqli_num_rows($Kd_ORMAquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($Kd_ORMAquery)) {?>
					<option> 
						<?php echo $row["Kd_ORMA"]?>
						
					</option>
				<?php } ?>
			<?php } ?>
			
			</select>
			</div>
		  </div>
<!--
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tugas">Tugas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tugas" name="Tugas" placeholder="Tugas">
			</div>
		  </div>
			  
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Judul_materi">Judul materi</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Judul_materi" name="Judul_materi" placeholder="Judul materi">
			</div>
		  </div> -->
		  
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
			<br><br><br><h1><b>HASIL ENTRI Dana Bipekskur</b></h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Kode Bipekstur</th>
				<th>Bipekstur Total</th>
				<th>Periode Tahun Akad</th>
				<th>Kode Organisasi Mahasiswa</th>				
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
					<td><?php echo $row['Kd_bipeks']; ?> </td>
					<td><?php echo $row['Bipeks_total']; ?> </td>
					<td><?php echo $row['Periode_th_akad']; ?> </td>
					<td><?php echo $row['Kd_ORMA']; ?> </td>
					
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="bipeksubah.php?bipeksubah=<?php echo $row["ID"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i></a>
						<a href="bipekshapus.php?bipekshapus=<?php echo $row["ID"]?>">   Delete</a> 
					</td>
				</tr>
				<?php $no++; ?> 
			<?php  } ?>
	<?php  } ?>
	</table>
	</div>
</div>
</div>
</div>

<?php include("adminfooter.php") ?>

<?php
mysqli_close($connection);
ob_end_flush();

?>
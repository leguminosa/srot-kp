
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {	
		if (isset($_REQUEST["ID"]))
			{	$ID_pembicara = $_REQUEST["ID"];
			} 
		if (!empty($ID))
			{	$ID = $_POST['ID'];	
			}
		$ID_pembicara = $_POST['ID_pembicara'];
		$ID_seminar = $_POST['ID_seminar'];
		$Tugas = $_POST['Tugas'];
		$Judul_materi = $_POST['Judul_materi'];
	
		
/** Memasukkan data fullname ke dalam tabel PelaksanaanSeminar**/
     mysqli_query($connection, "INSERT INTO PelaksanaanSeminar VALUES ('$ID','$ID_pembicara',
	 '$ID_seminar','$Tugas','$Judul_materi')"); 
     header("location:PelaksanaanSeminar.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM PelaksanaanSeminar");
	 $ID_pembicaraquery = mysqli_query ($connection, "SELECT * FROM pembicara ORDER BY ID_pembicara ASC");
	 $ID_seminarquery = mysqli_query ($connection, "SELECT * FROM temaseminar ORDER BY ID_seminar ASC");
?>	

<?php include("adminmenu.php") ?>

<div class="templatemo-content-wrapper">
<div class="templatemo-content entri-form">
	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>ENTRI DATA Pelaksanaan Seminar</h1><br>
	</div>	
<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="ID">ID</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="ID" name="ID" placeholder="ID Pelaksanaan" 
			  maxlength="5" required="">
			</div>
		  </div>
		  
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="ID_pembicara">ID pembicara</label>
			<div class="col-sm-2">
			<select name="ID_pembicara" class="form-control">
			<option value="ID_pembicara">NULL</option>
			<?php if (mysqli_num_rows($ID_pembicaraquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($ID_pembicaraquery)) {?>
					<option> 
						<?php echo $row["ID_pembicara"]?>
						
					</option>
				<?php } ?>
			<?php } ?>
			
			</select>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="ID_seminar">ID seminar</label>
			<div class="col-sm-2">
			<select name="ID_seminar" class="form-control">
			<option value="ID_seminar">NULL</option>
			<?php if (mysqli_num_rows($ID_seminarquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($ID_seminarquery)) {?>
					<option> 
						<?php echo $row["ID_seminar"]?>
						
					</option>
				<?php } ?>
			<?php } ?>
			
			</select>
			</div>
		  </div>

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
			<br><br><br><h1><b>HASIL ENTRI Pelaksanaan Seminar</b></h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>ID</th>
				<th>ID Pembicara</th>
				<th>ID Seminar</th>
				<th>TUGAS</th>
				<th>Judul Materi</th>
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
					<td><?php echo $row['ID']; ?> </td>
					<td><?php echo $row['ID_pembicara']; ?> </td>
					<td><?php echo $row['ID_seminar']; ?> </td>
					<td><?php echo $row['Tugas']; ?> </td>
					<td><?php echo $row['Judul_materi']; ?> </td>
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="pelaksanaanubah.php?pelaksanaanubah=<?php echo $row["ID"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i></a>
						<a href="pelaksanaanhapus.php?pelaksanaanhapus=<?php echo $row["ID"]?>">   Delete</a> 
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
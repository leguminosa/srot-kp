 
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {	
		if (isset($_REQUEST["Id_admin"]))
			{	$Id_admin = $_REQUEST["Id_admin"];
			} 
		if (!empty($Id_admin))
			{	$Id_admin = $_POST['Id_admin'];	
			}
		$Nama_admin = $_POST['Nama_admin'];
		$Jabatan= $_POST['Jabatan'];
		$Email= $_POST['Email'];
		$Password= $_POST['Password'];
		
		
		
/** Memasukkan data fullname ke dalam tabel universitas**/
     mysqli_query($connection, "INSERT INTO admin VALUES ('$Id_admin',
	 '$Nama_admin','$Jabatan','$Email','$Password')"); 
     header("location:pengelola1.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM admin");
 
?>	

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>Admin</h1><br>
		
	</div>			

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Id_admin">NID</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Id_admin" name="Id_admin" placeholder="Nomor Induk Karyawan" 
			  pattern=".{8,8}" maxlength="8" required title="harus 8 angka" required="">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_admin">Nama</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_admin" name="Nama_admin" placeholder="Nama">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Jabatan">Jabatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Jabatan" name="Jabatan" placeholder="Admin atau Bukan">
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
		  </div>
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
			<br><br><br><h1><b>HASIL ENTRI ADMIN</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>NID</th>
				<th>NAMA</th>
				<th>JABATAN</th>
				<th>EMAIL</th>
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
					<td><?php echo $row['Id_admin']; ?> </td>
					<td><?php echo $row['Nama_admin']; ?> </td>
					<td><?php echo $row['Jabatan']; ?> </td>
					<td><?php echo $row['Email']; ?> </td>
				
								
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="pengelola1ubah.php?pengelola1ubah=<?php echo $row["Id_admin"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="pengelola1hapus.php?pengelola1hapus=<?php echo $row["Id_admin"]?>">   Delete</a> 
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

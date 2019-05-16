 
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$Kd_kategori = $_POST['Kd_kategori'];
		$Nama_kategori = $_POST['Nama_kategori'];
		/**$Keterangan= $_POST['Keterangan'];
		$Email= $_POST['Email'];
		$Password= $_POST['Password'];**/
				
		mysqli_query($connection, "UPDATE kategorikegiatan SET Nama_kategori='$Nama_kategori' WHERE Kd_kategori='$Kd_kategori'"); 
		header("location:kategorikegiatan.php");
}

$Kd_kategori = $_GET["kategoriubah"] ;
$edit = mysqli_query($connection, "SELECT * FROM kategorikegiatan WHERE Kd_kategori = '$Kd_kategori'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM kategorikegiatan");
 
?>	

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>Kategori Kegiatan Ubah</h1><br>
		
	</div>			

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_kategori">Kode Kategori</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Kd_kategori" name="Kd_kategori" 
			  value = "<?php echo $row_edit['Kd_kategori']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_kategori">Nama Kategori</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_kategori" name="Nama_kategori" 
			  value = "<?php echo $row_edit['Nama_kategori']?>"/>
			</div>
		  </div>
 <!--
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Keterangan">Keterangan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Keterangan" name="Keterangan" placeholder="Keterangan">
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
-->
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
			<br><br><br><h1><b>HASIL ENTRI KATEGORI KEGIATAN</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>KODE KATEGORI</th>
				<th>NAMA KATEGORI</th>
				<!--<th>KETERANGAN</th>
				<th>EMAIL</th>
				<th>HAK AKSES</th> -->
					
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
					<td><?php echo $row['Kd_kategori']; ?> </td>
					<td><?php echo $row['Nama_kategori']; ?> </td>
					
					
								
					<td>
						<!--<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="pengelola1ubah.php?pengelola1ubah=<?php echo $row["Id_admin"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="pengelola1hapus.php?pengelola1hapus=<?php echo $row["Id_admin"]?>">   Delete</a>  -->
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

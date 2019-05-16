
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {	
		if (isset($_REQUEST["ID_seminar"]))
			{	$ID_seminar = $_REQUEST["ID_seminar"];
			} 
		if (!empty($ID_seminar))
			{	$ID_seminar = $_POST['ID_seminar'];	
			}
		$Judul_seminar = $_POST['Judul_seminar'];
		$Tema_seminar= $_POST['Tema_seminar'];
		$Tgl_seminar = $_POST['Tgl_seminar'];
		$Lokasi_seminar = $_POST['Lokasi_seminar'];
	$nama = $_FILES['file']['name']; /** untuk menampung data foto atau gambar **/ 
	$file_tmp = $_FILES["file"]["tmp_name"];
	move_uploaded_file($file_tmp, 'images/iconkabupaten/'.$nama); /** untuk upload file gambarnya **/		
		
/** Memasukkan data fullname ke dalam tabel Tema Seminar**/
     mysqli_query($connection, "INSERT INTO TemaSeminar VALUES ('$ID_seminar',
	 '$Judul_seminar','$Tema_seminar','$Tgl_seminar','$Lokasi_seminar','$nama')"); 
     header("location:TemaSeminar.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM TemaSeminar");
 
?>	
<?php include("adminmenu.php") ?>

<div class="templatemo-content-wrapper">
<div class="templatemo-content entri-form">
	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>ENTRI DATA TEMA SEMINAR</h1><br>
	</div>	
<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="ID_seminar">ID seminar</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="ID_seminar" name="ID_seminar" placeholder="ID seminar" 
			  maxlength="5" required="">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Judul_seminar">Judul seminar</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Judul_seminar" name="Judul_seminar" placeholder="Judul seminar">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tema_seminar">Tema seminar</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tema_seminar" name="Tema_seminar" placeholder="Tema seminar">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tgl_seminar">Tanggal seminar</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tgl_seminar" name="Tgl_seminar" placeholder="Tanggal seminar">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Lokasi_seminar">Lokasi seminar</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Lokasi_seminar" name="Lokasi_seminar" placeholder="Lokasi seminar">
			</div>
		  </div>
		  
		  <div class="form-group form-group">
			<label class="col-sm-3 control-label" for="file">Poster seminar</label>
			<div class="col-sm-9">
			  <input type="file" id="file" name="file">
			  <p class="help-block">Field ini digunakan untuk mengambil file gambar/foto ICON berita</p>
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
			<br><br><br><h1><b>HASIL ENTRI TEMA SEMINAR</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>ID seminar</th>
				<th>JUDUL</th>
				<th>TEMA</th>
				<th>TANGGAL</th>
				<th>LOKASI</th>
				<th>POSTER</th>				
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
					<td><?php echo $row['ID_seminar']; ?> </td>
					<td><?php echo $row['Judul_seminar']; ?> </td>
					<td><?php echo $row['Tema_seminar']; ?> </td>
					<td><?php echo $row['Tgl_seminar']; ?> </td>
					<td><?php echo $row['Lokasi_seminar']; ?> </td>
					
					<td>
						<?php if($row['poster']==""){ echo "<img src='images/noimage.png' width='88'/>";}else{?>
						<img src="images/poster/<?php echo $row['poster'] ?>" width="88" class="img-responsive" />
						<?php }?>
					</td>
								
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="temaubah.php?temaubah=<?php echo $row["ID_seminar"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i></a>
						<a href="temahapus.php?temahapus=<?php echo $row["ID_seminar"]?>">   Delete</a> 
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
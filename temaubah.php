
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$ID_seminar = $_POST['ID_seminar'];
		$Judul_seminar = $_POST['Judul_seminar'];
		$Tema_seminar= $_POST['Tema_seminar'];
		$Tgl_seminar= $_POST['Tgl_seminar'];
		$Lokasi_seminar= $_POST['Lokasi_seminar'];
			
		// MENGECEK APAKAH FOTO AKAN DIEDIT
				
				if(isset($_POST["ubahfoto"])) //JIKA USER MENKLIK CHECKBOX, AMBIL DATA FOTO
				{
					$poster = $_FILES ["foto"]["name"];
					$file_tmp = $_FILES ["foto"]["tmp_name"];
					move_uploaded_file ($file_tmp, "images/iconuniv" .$univFOTO);
				
				mysqli_query($connection, "UPDATE temaseminar SET Judul_seminar='$Judul_seminar',Tema_seminar='$Tema_seminar',
				Tgl_seminar='$Tgl_seminar',Lokasi_seminar='$Lokasi_seminar',poster='$poster' WHERE ID_seminar='$ID_seminar'"); 
				header("location:pembicaraubah.php");
				}
			
		mysqli_query($connection, "UPDATE temaseminar SET Judul_seminar='$Judul_seminar',Tema_seminar='$Tema_seminar',
		Tgl_seminar='$Tgl_seminar',Lokasi_seminar='$Lokasi_seminar',poster='$poster' WHERE ID_seminar='$ID_seminar'"); 
		header("location:pembicaraubah.php");
}

$ID_seminar = $_GET["temaubah"] ;
$edit = mysqli_query($connection, "SELECT * FROM temaseminar WHERE ID_seminar = '$ID_seminar'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM temaseminar");
 
?>	
<?php include("adminmenu.php") ?>


  <body>

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
			  <input class="form-control" type="text" id="ID_seminar" name="ID_seminar" 
			  value = "<?php echo $row_edit['ID_seminar']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Judul_seminar">Judul seminar</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Judul_seminar" name="Judul_seminar" 
			  value = "<?php echo $row_edit['Judul_seminar']?>"/>
			  </div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tema_seminar">Tema seminar</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tema_seminar" name="Tema_seminar" 
			  value = "<?php echo $row_edit['Tema_seminar']?>"/>
			  </div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tgl_seminar">Tanggal seminar</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tgl_seminar" name="Tgl_seminar" 
			value = "<?php echo $row_edit['Tgl_seminar']?>"/>
			</div>
		  </div>
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Lokasi_seminar">Lokasi_seminar</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Lokasi_seminar" name="Lokasi_seminar" 
			value = "<?php echo $row_edit['Lokasi_seminar']?>"/>
			</div>
		  </div>			  
		  
		  <div class="form-group form-group">
			<label class="col-sm-3 control-label" for="foto">Poster</label>
			<div class="col-sm-9">
			<input type = "checkbox" name="ubahfoto" value = "true"> beri tanda centang untuk mengubah foto </br>
			  <input type="file" id="foto" name="foto">
			  <img src ="images/poster/<?php echo $row_edit["poster"]?>" style = "width: 200px; height: 150px">
			  <p class="help-block">Field ini digunakan untuk mengambil file poster seminar</p>
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
			<br><br><br><h1><b>HASIL ENTRI TEMA SEMINAR</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>KODE</th>
				<th>NAMA</th>
				<th>ALAMAT</th>
				<th>TELP</th>
				<th>LINK</th>		
				<th>LOGO</th>
				<th>KETERANGAN LOGO</th>				
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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
	</body>
	</html>
	
	<?php include("adminfooter.php") ?>
	
	<?php
mysqli_close($connection);
ob_end_flush();

?>

<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {	
		if (isset($_REQUEST["ID_pembicara"]))
			{	$ID_pembicara = $_REQUEST["ID_pembicara"];
			} 
		if (!empty($ID_pembicara))
			{	$ID_pembicara = $_POST['ID_pembicara'];	
			}
		$Nama_pembicara = $_POST['Nama_pembicara'];
		$Gelar_pembicara = $_POST['Gelar_pembicara'];
		$Institut_pembicara = $_POST['Institut_pembicara'];
		$Alamat_pembicara = $_POST['Alamat_pembicara'];
	
		
/** Memasukkan data fullname ke dalam tabel pembicara**/
     mysqli_query($connection, "INSERT INTO pembicara VALUES ('$ID_pembicara',
	 '$Nama_pembicara','$Gelar_pembicara','$Institut_pembicara','$Alamat_pembicara')"); 
     header("location:Pembicara.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM pembicara");
 
?>	

<?php include("adminmenu.php") ?>

<div class="templatemo-content-wrapper">
<div class="templatemo-content entri-form">
	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>ENTRI DATA KASIR</h1><br>
	</div>	
<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="ID_pembicara">ID Kasir</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="ID_pembicara" name="ID_pembicara" placeholder="ID pembicara" 
			  maxlength="5" required="">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_pembicara">Nama Kasir</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_pembicara" name="Nama_pembicara" placeholder="Nama pembicara">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Alamat_pembicara">Alamat Kasir</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Alamat_pembicara" name="Alamat_pembicara" placeholder="Alamat pembicara">
			</div>
		  </div>
		  
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Institut_pembicara">No Hp</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Institut_pembicara" name="Institut_pembicara" placeholder="Institusi pembicara">
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
			<br><br><br><h1><b>HASIL ENTRI PEMBICARA</b></h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>ID</th>
				<th>NAMA</th>
				<th>GELAR</th>
				<th>INSTITUSI</th>
				<th>ALAMAT</th>
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
					<td><?php echo $row['ID_pembicara']; ?> </td>
					<td><?php echo $row['Nama_pembicara']; ?> </td>
					<td><?php echo $row['Gelar_pembicara']; ?> </td>
					<td><?php echo $row['Institut_pembicara']; ?> </td>
					<td><?php echo $row['Alamat_pembicara']; ?> </td>
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="pembicaraubah.php?pembicaraubah=<?php echo $row["ID_pembicara"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i></a>
						<a href="pembicarahapus.php?pembicarahapus=<?php echo $row["ID_pembicara"]?>">   Delete</a> </td>
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

<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$ID_pembicara = $_POST['ID_pembicara'];
		$Nama_pembicara = $_POST['Nama_pembicara'];
		$Gelar_pembicara= $_POST['Gelar_pembicara'];
		$Institut_pembicara= $_POST['Institut_pembicara'];
		$Alamat_pembicara= $_POST['Alamat_pembicara'];
				
		mysqli_query($connection, "UPDATE pembicara SET Nama_pembicara='$Nama_pembicara',Gelar_pembicara='$Gelar_pembicara',
		Institut_pembicara='$Institut_pembicara',Alamat_pembicara='$Alamat_pembicara' WHERE ID_pembicara='$ID_pembicara'"); 
		header("location:pembicaraubah.php");
}

$ID_pembicara = $_GET["ID_pembicara"] ;
$edit = mysqli_query($connection, "SELECT * FROM pembicara WHERE ID_pembicara = '$ID_pembicara'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM pembicara");
 
?>	
<?php include("adminmenu.php") ?>


  <body>

<div class="templatemo-content-wrapper">
<div class="templatemo-content entri-form">
	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>ENTRI DATA PEMBICARA</h1><br>
	</div>	
<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="ID_pembicara">ID pembicara</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="ID_pembicara" name="ID_pembicara" 
			  value = "<?php echo $row_edit['ID_pembicara']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_pembicara">Nama pembicara</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_pembicara" name="Nama_pembicara" 
			  value = "<?php echo $row_edit['Nama_pembicara']?>"/>
			  </div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Gelar_pembicara">Gelar pembicara</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Gelar_pembicara" name="Gelar_pembicara" 
			  value = "<?php echo $row_edit['Gelar_pembicara']?>"/>
			  </div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Institut_pembicara">Institut pembicara</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Institut_pembicara" name="uInstitut_pembicara" 
			value = "<?php echo $row_edit['Institut_pembicara']?>"/>
			</div>
		  </div>
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Alamat_pembicara">Alamat pembicara</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Alamat_pembicara" name="Alamat_pembicara" 
			value = "<?php echo $row_edit['Alamat_pembicara']?>"/>
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
			<br><br><br><h1><b>HASIL ENTRI PEMBICARA</h1>
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
						<a href="pembicarahapus.php?pembicarahapus=<?php echo $row["ID_pembicara"]?>">   Delete</a> 
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
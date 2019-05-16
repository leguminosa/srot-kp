
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$univKODE = $_POST['univKODE'];
		$univNAMA = $_POST['univNAMA'];
		$univALM= $_POST['univALM'];
		$univTELP= $_POST['univTELP'];
		$univLINK= $_POST['univLINK'];
		$univFOTO = $_POST['univFOTO'];
		$univFOTOKET = $_POST['univFOTOKET'];	
				
				// MENGECEK APAKAH FOTO AKAN DIEDIT
				
				if(isset($_POST["ubahfoto"])) //JIKA USER MENKLIK CHECKBOX, AMBIL DATA FOTO
				{
					$univFOTO = $_FILES ["foto"]["name"];
					$file_tmp = $_FILES ["foto"]["tmp_name"];
					move_uploaded_file ($file_tmp, "images/iconuniv" .$univFOTO);
				
				mysqli_query($connection, "UPDATE universitas SET univNAMA='$univNAMA',univALM='$univALM',
				univTELP='$univTELP',univLINK='$univLINK',univFOTO='$univFOTO',univFOTOKET='$univFOTOKET' WHERE univKODE='$univKODE'"); 
				header("location:UnivUbah.php");
				}
				
				
				
		mysqli_query($connection, "UPDATE universitas SET univNAMA='$univNAMA',univALM='$univALM',
		univTELP='$univTELP',univLINK='$univLINK',univFOTO='$univFOTO',univFOTOKET='$univFOTOKET' WHERE univKODE='$univKODE'"); 
		header("location:UnivUbah.php");
}

$univKODE = $_GET["UnivUbah"] ;
$edit = mysqli_query($connection, "SELECT * FROM universitas WHERE univKODE = '$univKODE'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM universitas");
 
?>	
<?php include("adminmenu.php") ?>


  <body>

<div class="templatemo-content-wrapper">
<div class="templatemo-content entri-form">
	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>ENTRI DATA UNIVERSITAS</h1><br>
	</div>	
<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univKODE">Kode Universitas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univKODE" name="univKODE" 
			  value = "<?php echo $row_edit['univKODE']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univNAMA">Nama Universitas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univNAMA" name="univNAMA" 
			  value = "<?php echo $row_edit['univNAMA']?>"/>
			  </div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univALM">Alamat Universitas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univALM" name="univALM" 
			  value = "<?php echo $row_edit['univALM']?>"/>
			  </div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univTELP">Telp Universitas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univTELP" name="univTELP" 
			value = "<?php echo $row_edit['univTELP']?>"/>
			</div>
		  </div>
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univLINK">Link Universitas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univLINK" name="univLINK" 
			value = "<?php echo $row_edit['univLINK']?>"/>
			</div>
		  </div>

		  <div class="form-group form-group">
			<label class="col-sm-3 control-label" for="foto">Logo Universitas</label>
			<div class="col-sm-9">
			<input type = "checkbox" name="ubahfoto" value = "true"> beri tanda centang untuk mengubah foto </br>
			  <input type="file" id="foto" name="foto">
			  <img src ="images/iconuniv/<?php echo $row_edit["univFOTO"]?>" style = "width: 200px; height: 150px">
			  <p class="help-block">Field ini digunakan untuk mengambil file gambar/foto ICON universitas</p>
			</div>
		  </div>			  
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univFOTOKET">Keterangan Logo</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univFOTOKET" name="univFOTOKET" 
			  value = "<?php echo $row_edit['univFOTOKET']?>"/>
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
			<br><br><br><h1><b>HASIL ENTRI KABUPATEN</h1>
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
					<td><?php echo $row['univKODE']; ?> </td>
					<td><?php echo $row['univNAMA']; ?> </td>
					<td><?php echo $row['univALM']; ?> </td>
					<td><?php echo $row['univTELP']; ?> </td>
					<td><?php echo $row['univLINK']; ?> </td>
					
					<td>
						<?php if($row['univFOTO']==""){ echo "<img src='images/noimage.png' width='88'/>";}else{?>
						<img src="images/iconuniv/<?php echo $row['univFOTO'] ?>" width="88" class="img-responsive" />
						<?php }?>
					</td>
					<td><?php echo $row['univFOTOKET'];?></td>					
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="UnivUbah.php?UnivUbah=<?php echo $row["univKODE"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="actionHapus.php?actionHapus=<?php echo $row["univKODE"]?>">   Delete</a> 
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
<?php


include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$fasilitasKODE = $_POST['fasilitasKODE'];
		$fasilitasNAMA = $_POST['fasilitasNAMA'];
		$fasilitasGUNA= $_POST['fasilitasGUNA'];
		
		$TglFasilitas= $_POST['TglFasilitas'];
		
				
				// MENGECEK APAKAH FOTO AKAN DIEDIT
				
				if(isset($_POST["ubahfoto"])) //JIKA USER MENKLIK CHECKBOX, AMBIL DATA FOTO
				{
					$univFOTO = $_FILES ["foto"]["name"];
					$file_tmp = $_FILES ["foto"]["tmp_name"];
					move_uploaded_file ($file_tmp, "images/iconuniv" .$FotoFasilitas);
				
				mysqli_query($connection, "UPDATE fasilitas SET fasilitasNAMA='$fasilitasNAMA',fasilitasGUNA='$fasilitasGUNA',
				TglFasilitas='$TglFasilitas',FotoFasilitas='$FotoFasilitas' WHERE fasilitasKODE='$fasilitasKODE'"); 
				header("location:fasilitasubah.php");
				}
				
				
				
		mysqli_query($connection, "UPDATE fasilitas SET fasilitasNAMA='$fasilitasNAMA',fasilitasGUNA='$fasilitasGUNA',
				TglFasilitas='$TglFasilitas',FotoFasilitas='$FotoFasilitas' WHERE fasilitasKODE='$fasilitasKODE'"); 
				header("location:fasilitasubah.php");
}

$fasilitasKODE = $_GET["fasilitasKODE"] ;
$edit = mysqli_query($connection, "SELECT * FROM fasilitas WHERE fasilitasKODE = '$fasilitasKODE'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM fasilitas");
 
?>	



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
			<label class="col-sm-3 control-label" for="fasilitasKODE">Kode Fasilitas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="fasilitasKODE" name="fasilitasKODE" placeholder="Kode Fasilitas" 
			  maxlength="4" required="">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="fasilitasNAMA">Nama Fasilitas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="fasilitasNAMA" name="fasilitasNAMA" placeholder="Nama Fasilitas">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="fasilitasGuna">Guna Fasilitas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="fasilitasGuna" name="fasilitasGuna" placeholder="Guna Fasilitas">
			</div>
		  </div>

		  <div class="form-group">
			<label class="col-sm-3 control-label" for="file">Foto Fasilitas</label>
			<div class="col-sm-9">
			<input type="file" id="file" name="file">
			<p class="help-block">Field ini digunakan untuk mengambil file/gambar/foto ICON berita</p>
			</div>
			</div>
			  
		  
		 <div class="form-group form-group-lg">		
			
			<label class="col-sm-3 control-label" for="datepicker">Tanggal Fasilitas</label>
			<div class="col-sm-6">
			<input class="form-control" type="text" id="datepicker" name="TglFasilitas"
			placeholder="YYYY-MM-DD">			
			</div>
		</div>
		  
		  <div class="col-sm-2">
		  
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
				<th>KODE</th>
				<th>NAMA</th>
				<th>GUNA</th>
				<th>FOTO</th>
				<th>TANGGAL</th>
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
					<td><?php echo $row['fasilitasKODE']; ?> </td>
					<td><?php echo $row['fasilitasNAMA']; ?> </td>
					<td><?php echo $row['fasilitasGUNA']; ?> </td>
					<td>
						<?php if($row['FotoFasilitas']==""){ echo "<img src='images/noimage.png' width='88'/>";}else{?>
						<img src="images/fotofasilitas/<?php echo $row['FotoFasilitas'] ?>" width="88" class="img-responsive" />
						<?php }?>
					</td>
					<td><?php echo $row['TglFasilitas']; ?> </td>
				
					<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="fasilitasubah.php?fasilitasubah=<?php echo $row["fasilitasKODE"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="fasilitashapus.php?fasilitashapus=<?php echo $row["fasilitasKODE"]?>">   Delete</a> 
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
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {	
		if (isset($_REQUEST["fasilitasKODE"]))
			{	$fasilitasKODE = $_REQUEST["fasilitasKODE"];
			} 
		if (!empty($fasilitasKODE))
			{	$fasilitasKODE = $_POST['fasilitasKODE'];	
			}
		$fasilitasNAMA = $_POST['fasilitasNAMA'];
		$fasilitasGuna= $_POST['fasilitasGuna'];
		
		
	$nama = $_FILES['file']['name']; /** untuk menampung data foto atau gambar **/ 
	$file_tmp = $_FILES["file"]["tmp_name"];
	move_uploaded_file($file_tmp, 'images/fotofasilitas/'.$nama); /** untuk upload file gambarnya **/		
	
$Tgl_seminar = $_POST['Tgl_seminar'];
	
/** Memasukkan data fullname ke dalam tabel Tema Seminar**/
     mysqli_query($connection, "INSERT INTO fasilitas VALUES ('$fasilitasKODE',
	 '$fasilitasNAMA','$fasilitasGuna','$Tgl_seminar','$FotoFasilitas','$nama')"); 
     header("location:fasilitas1.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM fasilitas");
 
?>	
<div class="templatemo-content-wrapper">
<div class="templatemo-content entri-form">
	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>ENTRI DATA FASILITAS</h1><br>
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

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Institut_pembicara">Institut pembicara</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Institut_pembicara" name="Institut_pembicara" placeholder="Institusi pembicara">
			</div>
		  </div>
			  
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="TglFasilitas">Tanggal Fasilitas</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="TglFasilitas" name="TglFasilitas" placeholder="Tanggal Fasilitas">
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
					<td><?php echo $row['fasilitasGuna']; ?> </td>
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
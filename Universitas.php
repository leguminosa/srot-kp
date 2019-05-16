 
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {	
		if (isset($_REQUEST["univKODE"]))
			{	$univKODE = $_REQUEST["univKODE"];
			} 
		if (!empty($univKODE))
			{	$univKODE = $_POST['univKODE'];	
			}
		$univNAMA = $_POST['univNAMA'];
		$univALM= $_POST['univALM'];
		$univTELP= $_POST['univTELP'];
		$univLINK= $_POST['univLINK'];
	$nama = $_FILES['file']['name']; /** untuk menampung data foto atau gambar **/ 
	$file_tmp = $_FILES["file"]["tmp_name"];
	move_uploaded_file($file_tmp, 'images/iconuniv/'.$nama); /** untuk upload file gambarnya **/
		$univFOTOKET = $_POST['univFOTOKET'];			
		
/** Memasukkan data fullname ke dalam tabel universitas**/
     mysqli_query($connection, "INSERT INTO universitas VALUES ('$univKODE',
	 '$univNAMA','$univALM','$univTELP','$univLINK','$nama','$univFOTOKET')"); 
     header("location:Universitas.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM universitas");
 
?>	

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>PEMBELIAN</h1><br>
		
	</div>			

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univKODE">NID</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univKODE" name="univKODE" placeholder="Kode Universitas" 
			  maxlength="5" required="">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univNAMA">Nama Barang</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univNAMA" name="univNAMA" placeholder="Nama Universitas">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univALM">Quantity</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univALM" name="univALM" placeholder="Alamat Universitas">
			</div>
		  </div>

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univTELP">Harga Barang Beli</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univTELP" name="univTELP" placeholder="Telp Universitas">
			</div>
		  </div>
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univLINK">Harga Barang Jual</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univLINK" name="univLINK" placeholder="Link Universitas">
			</div>
		  </div>

		  <div class="form-group form-group">
			<label class="col-sm-3 control-label" for="file">Gambar Barang</label>
			<div class="col-sm-9">
			  <input type="file" id="file" name="file">
			  <p class="help-block">Field ini digunakan untuk mengambil logo universitas</p>
			</div>
		  </div>			  
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="univFOTOKET">Tanggal Beli</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="univFOTOKET" name="univFOTOKET" placeholder="Keterangan Logo">
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
			<br><br><br><h1><b>HASIL ENTRI UNIVERSITAS</h1>
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
						<a href="univhapus.php?univhapus=<?php echo $row["univKODE"]?>">   Delete</a> 
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

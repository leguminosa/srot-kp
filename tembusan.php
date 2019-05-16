 
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {	
		if (isset($_REQUEST["Kd_Tembusan"]))
			{	$Kd_Tembusan = $_REQUEST["Kd_Tembusan"];
			} 
		if (!empty($Kd_Tembusan))
			{	$Kd_Tembusan = $_POST['Kd_Tembusan'];	
			}
		$Nama_Tembusan = $_POST['Nama_Tembusan'];
		
/** Memasukkan data fullname ke dalam tabel universitas**/
     mysqli_query($connection, "INSERT INTO tembusan VALUES ('$Kd_Tembusan',
	 '$Nama_Tembusan')"); 
     header("location:tembusan.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM tembusan");
 
?>	

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>Tahun Akad</h1><br>
		
	</div>			

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		 <!-- <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Kd_Tembusan">Periode Tahun Akad</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Kd_Tembusan" name="Kd_Tembusan" placeholder="Periode Tahun Akad" 
			  maxlength="10" required="">
			</div>
		  </div> -->

		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Nama_Tembusan">Nama Tembusan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Nama_Tembusan" name="Nama_Tembusan" placeholder="Nama Tembusan">
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
			<br><br><br><h1><b>HASIL ENTRI Tembusan</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>No</th>
				
				<th>Nama Tembusan</th>
				<th>Action</th>	
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
					
					<td><?php echo $row['Nama_Tembusan']; ?> </td>
								
					<td>
						
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="tembusanhapus.php?tembusanhapus=<?php echo $row["Kd_Tembusan"]?>">   Delete</a> 
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

 
<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";

//** MENGECEK APAKAH TOMBOL UPDATE SUDAH DI KLIK

if(isset ($_POST["Update"]))
{
		$No_proposal = $_POST['No_proposal'];
		$Nama_kegiatan = $_POST['Nama_kegiatan'];
		$Tgl_masuk_proposal= $_POST['Tgl_masuk_proposal'];
		$Tgl_pelaksanaan= $_POST['Tgl_pelaksanaan'];
		$Tempat_pelaksanaan= $_POST['Tempat_pelaksanaan'];
		$Tema_kegiatan= $_POST['Tema_kegiatan'];
		$Total_kegiatan= $_POST['Tema_kegiatan'];
		$Bipeks_Terprogram= $_POST['Bipeks_Terprogram'];
		$Kd_kategori= $_POST['Kd_kategori'];
		$Kd_kegiatan= $_POST['Kd_kegiatan'];
				
		mysqli_query($connection, "UPDATE proposal SET Nama_kegiatan='$Nama_kegiatan',Tgl_masuk_proposal='$Tgl_masuk_proposal',
		Tgl_pelaksanaan='$Tgl_pelaksanaan',Tempat_pelaksanaan='$Tempat_pelaksanaan', Tema_kegiatan='$Tema_kegiatan',Total_kegiatan='$Total_kegiatan',
		Bipeks_Terprogram='$Bipeks_Terprogram',Kd_kategori='$Kd_kategori', Kd_kegiatan='$Kd_kegiatan' 
		WHERE No_proposal='$No_proposal'"); 
		header("location:proposal.php");
}

$No_proposal = $_GET["proposalubah"] ;
$edit = mysqli_query($connection, "SELECT * FROM proposal WHERE No_proposal = '$No_proposal'");
$row_edit = mysqli_fetch_array($edit);
	 $query = mysqli_query($connection, "SELECT * FROM proposal");
	 
?>	

<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>	
		<h1><b>Proposal Ubah</h1><br>
		
	</div>			

<div class="row">
	<div class="col-sm-12">
		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		  
		  <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tgl_masuk_proposal">Tanggal Masuk Proposal</label>
			<div class="col-sm-6">
			  <input class="form-control" type="date" id="Tgl_masuk_proposal" name="Tgl_masuk_proposal" placeholder="dd/mm/yyyy"
			  value = "<?php echo $row_edit['Tgl_masuk_proposal']?>"/>
			</div>
		  </div>
		 <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tgl_pelaksanaan">Tanggal Pelaksanaan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="date" id="Tgl_pelaksanaan" name="Tgl_pelaksanaan" placeholder="Tanggal Pelaksanaan"
			  value = "<?php echo $row_edit['Tgl_pelaksanaan']?>"/>
			</div>
		  </div>
		
		 <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tempat_pelaksanaan">Tempat Pelaksanaan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tempat_pelaksanaan" name="Tempat_pelaksanaan" placeholder="Tempat Pelaksanaan"
			  value = "<?php echo $row_edit['Tempat_pelaksanaan']?>"/>
			</div>
		  </div>
				
		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Tema_kegiatan">Tema Kegiatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Tema_kegiatan" name="Tema_kegiatan" placeholder="Tema Kegiatan"
			  value = "<?php echo $row_edit['Tema_kegiatan']?>"/>
			</div>
		  </div>
		
		   <div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="Total_kegiatan">Total Kegiatan</label>
			<div class="col-sm-6">
			  <input class="form-control" type="text" id="Total_kegiatan" name="Total_kegiatan" placeholder="Total Kegiatan"
			  value = "<?php echo $row_edit['Total_kegiatan']?>"/>
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
			<br><br><br><h1><b>HASIL ENTRI ADMIN</h1>
		</div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Nomor Proposal</th>
				<th>Nama Kegiatan</th>
				<th>Tanggal Masuk Proposal</th>
				<th>Tanggal Pelaksanaan</th>
				<th>Tempat Pelaksanaan</th>
				<th>Tema Kegiatan</th>
				<th>Total Kegiatan</th>
				<th>Bipeks Terprogram</th>
				<th>Kode Kategori</th>
					
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
					<td><?php echo $row['No_proposal']; ?> </td>
					<td><?php echo $row['Nama_kegiatan']; ?> </td>
					<td><?php echo $row['Tgl_masuk_proposal']; ?> </td>
					<td><?php echo $row['Tgl_pelaksanaan']; ?> </td>
					<td><?php echo $row['Tempat_pelaksanaan']; ?> </td>
					<td><?php echo $row['Tema_kegiatan']; ?> </td>
					<td><?php echo $row['Total_kegiatan']; ?> </td>
					<td><?php echo $row['Bipeks_terprogram']; ?> </td>
					<td><?php echo $row['Kd_kategori']; ?> </td>
				
				<td>
						<a href="javascript:;"><i class="fa fa-pencil-square-o"></i>
						<a href="proposalubah.php?proposalubah=<?php echo $row["No_proposal"]?>">   Update</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="proposalhapus.php?proposalhapus=<?php echo $row["No_proposal"]?>">   Delete</a> 
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

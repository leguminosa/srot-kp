<?php
	ob_start();
	session_start();
	if(!isset($_SESSION['admin_EMAIL'])) header("location:loginADMIN.php");

	include "includes/config.php";
	require_once("includes/classes/Truck.php");
	$self = new Truck();

	$data = "";
	//on page load
	if (array_key_exists('edit', $_GET)) {
		$id = $_GET['edit'];

		//query update
		$query = $self->selectById($id);
		$result = mysqli_query($connection, $query);
		$data = mysqli_fetch_array($result);
		// header("location:truck.php");
	} else if (array_key_exists('del', $_GET)) {
		$id = $_GET['del'];

		//query update
		$query = $self->delete($id);
		$result = mysqli_query($connection, $query);
		header("location:truck.php");
	}

	if (isset($_POST['Simpan'])) {
		$nama = $_POST['kendaraan'];
		$status = $_POST['supir'];
		$muatan = $_POST['plat'];
		$nama_file = $_FILES['file']['name']; /** untuk menampung data foto atau gambar **/ 
		$file_tmp = $_FILES["file"]["tmp_name"];
		move_uploaded_file($file_tmp, 'images/truck/'.$nama_file); /** untuk upload file gambarnya **/
		if (array_key_exists('edit', $_GET)) {
			$id = $_GET['edit'];

			//query update
			$query = $self->update($id, $nama, $status, $muatan, $nama_file);
			$result = mysqli_query($connection, $query);
			header("location:truck.php");
		} else {

			//query insert
			$queryins = $self->insert($nama, $status, $muatan, $nama_file);
			$resultins = mysqli_query($connection, $queryins);
			header("location:truck.php");
		}
		
	}

	$query = $self->selectAll();
    $statuses = $self->selectAllStatus();
    $supirs = $self->selectAllSupir();
	$result = mysqli_query($connection, $query);
	// print_r($query); die();
    $stat = mysqli_query($connection, $statuses);
    $sup = mysqli_query($connection, $supirs);
	// print_r($result); die();
?>

<?php include("adminmenu.php") ?>

<div class="etri-form" style="margin-top: -15px";>
	<h1><b>Truck</h1><br>
</div>

<div class="row">
<div class="col-sm-12">
	<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="kendaraan">Kendaraan</label>
			<div class="col-sm-6">
				<select class="form-control" id="kendaraan" name="kendaraan" required="">
					<option value="">Silahkan Pilih</option>
<?php 	if(mysqli_num_rows($stat) > 0) { ?>
<?php 		while($st = mysqli_fetch_array($stat)) { ?>
					<option value="<?php echo $st["id_kendaraan"]; ?>" <?php if($data) { if($st["id_kendaraan"] == $data['id_kendaraan']) { ?> selected <?php } } ?>><?php echo $st["nama_kendaraan"]; ?></option>
<?php 		} ?>
<?php 	} ?>
<?php ?>
				</select>
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="supir">Supir</label>
			<div class="col-sm-6">
				<select class="form-control" id="supir" name="supir" required="">
					<option value="">Silahkan Pilih</option>
<?php 	if(mysqli_num_rows($sup) > 0) { ?>
<?php 		while($st = mysqli_fetch_array($sup)) { ?>
					<option value="<?php echo $st["id_supir"]; ?>" <?php if($data) { if($st["id_supir"] == $data['id_supir']) { ?> selected <?php } } ?>><?php echo $st["nama_supir"]; ?></option>
<?php 		} ?>
<?php 	} ?>
<?php ?>
				</select>
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="plat">No. Polisi</label>
			<div class="col-sm-6">
				<input class="form-control" type="text" id="plat" name="plat" placeholder="" required="" value="<?php if($data) {echo $data['no_polisi'];} ?>">
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="file">Foto</label>
			<div class="col-sm-9">
<?php if($data) { ?>
				<img src="images/truck/<?php echo $data['gambar']?>" style="width:200px;height:auto;"/><br>
<?php } ?>
				<input type="file" id="file" name="file">
				<p class="help-block">Field ini digunakan untuk mengunggah foto truck</p>
			</div>
		</div>			  
		<div class="col-sm-3"></div>
		<div class="col-sm-4">
			<input class="btn btn-lg btn-primary" type="submit" value="Simpan" name="Simpan">
			<!-- tombol diperbesar dg -lg dan berwarna biru dengan -primary -->
			<input class="btn btn-lg btn-info" type="reset" value="Batal"> <!-- tombol berwarna hijau langit -->
		</div>
	</form>

	<table class="table table-hover">
		<div class="etri-form">
			<br><br><br><h1><b>HASIL ENTRI TRUCK</h1>
		</div>

		<div>
        </div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Nama Kendaraan</th>
				<th>Nama Supir</th>
				<th>No Polisi</th>
				<th>Gambar</th>
				<th>Action</th>
				</tr>
	<?php
		/** Memeriksa apakah data yang dipanggil tersebut tersedia atau tidak **/
		if(mysqli_num_rows($result)>0)
	{?>
		<?php $no=1; ?>
		<?php while ($row = mysqli_fetch_array($result))
			{ ?>
				<tr class="danger" height="20px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row['nama_kendaraan']; ?> </td>
					<td><?php echo $row['nama_supir']; ?> </td>
					<td><?php echo $row['no_polisi']; ?> </td>
					<td><?php if($row['gambar'] == "") { echo "<img src='images/noimage.png' width='88'/>"; } else { echo "<img src='images/truck/".$row['gambar']."' width='88'/>"; } ?> </td>


					<td>
						<a href="truck.php?edit=<?php echo $row["id"]?>">   Ubah</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="truck.php?del=<?php echo $row["id"]?>">   Hapus</a>
					</td>
				</tr>
				<?php $no++; ?>
			<?php  } ?>
	<?php  } ?>
	</table>
</div>
</div>

<?php include("adminfooter.php") ?>

<script>
	$("#No_proposal").select2({ placeholder: "Silahkan pilih" });
</script>

<?php
	mysqli_close($connection);
	ob_end_flush();
?>

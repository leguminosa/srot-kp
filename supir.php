<?php
	ob_start();
	session_start();
	if(!isset($_SESSION['admin_EMAIL'])) header("location:loginADMIN.php");

	include "includes/config.php";
	require_once("includes/classes/Supir.php");
	$supir = new Supir();

	$data = "";
	//on page load
	if (array_key_exists('edit', $_GET)) {
		$id_supir = $_GET['edit'];

		//query update
		$query = $supir->selectById($id_supir);
		$result = mysqli_query($connection, $query);
		$data = mysqli_fetch_array($result);
		// header("location:supir.php");
	} else if (array_key_exists('del', $_GET)) {
		$id_supir = $_GET['del'];

		//query update
		$query = $supir->delete($id_supir);
		$result = mysqli_query($connection, $query);
		header("location:supir.php");
	}

	if (isset($_POST['Simpan'])) {
		$nama = $_POST['nama'];
		$status = $_POST['status'];
		if (array_key_exists('edit', $_GET)) {
			$id_supir = $_GET['edit'];

			//query update
			$query = $supir->update($id_supir, $nama, $status);
			$result = mysqli_query($connection, $query);
			header("location:supir.php");
		} else {

			//query insert
			$queryins = $supir->insert($nama, $status);
			$resultins = mysqli_query($connection, $queryins);
			header("location:supir.php");
		}
		
	}

	$query = $supir->selectAll();
    $statuses = $supir->selectAllStatus();
    $result = mysqli_query($connection, $query);
    $stat = mysqli_query($connection, $statuses);
	// print_r($result); die();
?>

<?php include("adminmenu.php") ?>

<div class="etri-form" style="margin-top: -15px";>
	<h1><b>Supir</h1><br>
</div>

<div class="row">
<div class="col-sm-12">
	<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="No_SIK">Nama</label>
			<div class="col-sm-6">
				<input class="form-control" type="text" id="nama" name="nama" placeholder="" required="" value="<?php if($data) {echo $data['nama_supir'];} ?>">
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="status">Status</label>
			<div class="col-sm-6">
				<select class="form-control" id="status" name="status" required="">
					<option value="">Silahkan Pilih</option>
<?php 	if(mysqli_num_rows($stat) > 0) { ?>
<?php 		while($st = mysqli_fetch_array($stat)) { ?>
					<option value="<?php echo $st["id"]; ?>" <?php if($data) { if($st["id"] == $data['id_status']) { ?> selected <?php } } ?>><?php echo $st["status"]; ?></option>
<?php 		} ?>
<?php 	} ?>
<?php ?>
				</select>
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
			<br><br><br><h1><b>HASIL ENTRI SUPIR</h1>
		</div>

		<div>
        </div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Nama Supir</th>
				<th>Status</th>
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
					<td><?php echo $row['nama_supir']; ?> </td>
					<td><?php echo $row['status']; ?> </td>


					<td>
						<a href="supir.php?edit=<?php echo $row["id_supir"]?>">   Ubah</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="supir.php?del=<?php echo $row["id_supir"]?>">   Hapus</a>
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

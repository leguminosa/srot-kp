<?php
	ob_start();
	session_start();
	if(!isset($_SESSION['admin_EMAIL'])) header("location:loginADMIN.php");

	include "includes/config.php";
	require_once("includes/classes/Jenis.php");
	$self = new Jenis();

	$data = "";
	//on page load
	if (array_key_exists('edit', $_GET)) {
		$id = $_GET['edit'];

		//query update
		$query = $self->selectById($id);
		$result = mysqli_query($connection, $query);
        $data = mysqli_fetch_array($result);
		// header("location:jenis.php");
	} else if (array_key_exists('del', $_GET)) {
		$id = $_GET['del'];

		//query update
		$query = $self->delete($id);
		$result = mysqli_query($connection, $query);
		header("location:jenis.php");
	}

	if (isset($_POST['Simpan'])) {
        $nama = $_POST['nama'];
        $status = $_POST['banyak_roda'];
        $ket = $_POST['keterangan'];
		if (array_key_exists('edit', $_GET)) {
			$id = $_GET['edit'];

			//query update
			$query = $self->update($id, $nama, $status, $ket);
			$result = mysqli_query($connection, $query);
			header("location:jenis.php");
		} else {

			//query insert
			$queryins = $self->insert($nama, $status, $ket);
			$resultins = mysqli_query($connection, $queryins);
			header("location:jenis.php");
		}
		
	}

    $query = $self->selectAll();
    $result = mysqli_query($connection, $query);
?>

<?php include("adminmenu.php") ?>

<div class="etri-form" style="margin-top: -15px";>
	<h1><b>Jenis Kendaraan</h1><br>
</div>

<div class="row">
<div class="col-sm-12">
	<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="nama">Nama</label>
			<div class="col-sm-6">
				<input class="form-control" type="text" id="nama" name="nama" placeholder="" required="" value=<?php if($data) {echo $data['nama'];} ?>>
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="banyak_roda">Banyak Roda</label>
			<div class="col-sm-6">
				<input class="form-control" type="text" id="banyak_roda" name="banyak_roda" placeholder="" required="" value=<?php if($data) {echo $data['banyak_roda'];} ?>>
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-3 control-label" for="keterangan">Keterangan</label>
			<div class="col-sm-6">
				<textarea class="form-control" type="text" id="keterangan" name="keterangan" rows="3" placeholder="" value=""><?php if($data) {echo $data['keterangan'];} ?></textarea>
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
			<br><br><br><h1><b>HASIL ENTRI JENIS KENDARAAN</h1>
		</div>

		<div>
        </div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Jenis Truk</th>
				<th>Jumlah Roda</th>
				<th>Keterangan</th>
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
					<td><?php echo $row['nama']; ?> </td>
					<td><?php echo $row['banyak_roda']; ?> </td>
					<td><?php echo $row['keterangan']; ?> </td>


					<td>
						<a href="jenis.php?edit=<?php echo $row["id_jenis"]?>">   Ubah</a> |
						<a href="javascript:;"><i class="fa fa-scissors"></i>
						<a href="jenis.php?del=<?php echo $row["id_jenis"]?>">   Hapus</a>
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

<?php
	ob_start();
	session_start();
	if(!isset($_SESSION['admin_EMAIL'])) header("location:loginADMIN.php");

	include "includes/config.php";
	require_once("includes/classes/DetailBooking.php");
	$self = new DetailBooking();

	$data = "";
	//on page load
	$user = $_SESSION['admin_KODE'];
	if (array_key_exists('order', $_GET)) {
		$id = $_GET['order'];

		//query update
		$query = $self->insert($user, $id);
		$result = mysqli_query($connection, $query);
        header("location:order.php");
	} else if (array_key_exists('del', $_GET)) {
		$id = $_GET['del'];

		//query update
		$query = $self->delete($id);
		$result = mysqli_query($connection, $query);
		header("location:order.php");
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
			header("location:order.php");
		} else {

			//query insert
			$queryins = $self->insert($nama, $status, $ket);
			$resultins = mysqli_query($connection, $queryins);
			header("location:order.php");
		}
		
	}

	$query = $self->selectAll();
	// print_r($query); die();
    $result = mysqli_query($connection, $query);
?>

<?php include("adminmenu.php") ?>

<div class="etri-form" style="margin-top: -15px";>
	<!-- <h1><b>Jenis Kendaraan</h1><br> -->
</div>

<div class="row">
<div class="col-sm-12">
	<table class="table table-hover">
		<div class="etri-form">
			<br><br><br><h1><b>LAPORAN PEMESANAN</h1>
		</div>

		<div>
        </div>
	<!-- membuat judul -->
	<tr class="info">
				<th>NO</th>
				<th>Tanggal Booking</th>
				<th>Nama Pemesan</th>
				<th>Nama Kendaraan</th>
				<th>Nama Supir</th>
				<th>No Polisi</th>
				<th>Gambar</th>
				<th>Status</th>
				<!-- <th>Action</th> -->
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
					<td><?php echo $row['tanggal']; ?> </td>
					<td><?php echo $row['nama_user']; ?> </td>
					<td><?php echo $row['nama_kendaraan']; ?> </td>
					<td><?php echo $row['nama_supir']; ?> </td>
					<td><?php echo $row['no_polisi']; ?> </td>
					<td><?php if($row['gambar'] == "") { echo "<img src='images/noimage.png' width='88'/>"; } else { echo "<img src='images/truck/".$row['gambar']."' width='88'/>"; } ?> </td>
					<td><?php echo $row['statusname']; ?> </td>


					<!-- <td>
						<a href="katalog.php?order=<?php echo $row["id_booking"]?>" onclick="JavaScript: return confirm('Konfirmasi nyatakan Truck dengan Nomor Polisi <?= $row['no_polisi']; ?> selesai?')">   Close</a>
					</td> -->
				</tr>
				<?php $no++; ?>
			<?php  } ?>
	<?php  } ?>
	</table>
	<button type="button" class="btn btn-primary" onclick="window.print();" style="float:right;">CLICK HERE TO PRINT FORM!</button>
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

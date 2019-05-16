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
	if (array_key_exists('close', $_GET)) {
		$id = $_GET['close'];

		//query update
		$query = $self->close_transaction($id);
		$result = mysqli_query($connection, $query);
        header("location:ongoing_orders.php");
	}

	$query = $self->selectAllOngoing();
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
			<br><br><br><h1><b>ORDER AKTIF</h1>
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
					<td><?php echo $row['tanggal']; ?> </td>
					<td><?php echo $row['nama_user']; ?> </td>
					<td><?php echo $row['nama_kendaraan']; ?> </td>
					<td><?php echo $row['nama_supir']; ?> </td>
					<td><?php echo $row['no_polisi']; ?> </td>
					<td><?php if($row['gambar'] == "") { echo "<img src='images/noimage.png' width='88'/>"; } else { echo "<img src='images/truck/".$row['gambar']."' width='88'/>"; } ?> </td>
					<td><?php echo $row['statusname']; ?> </td>


					<td>
						<a href="ongoing_orders.php?close=<?php echo $row["id_booking"]?>" onclick="JavaScript: return confirm('Konfirmasi nyatakan perjalanan Truck dengan Nomor Polisi <?= $row['no_polisi']; ?> selesai?')">   Close</a>
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

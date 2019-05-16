<!-- ADMIN index -->
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

	include ("includes/config.php");
	include ("adminmenu.php");
?>
<?php
    if(isset($_POST['Kd_ORMA'])) {
        $post = $_POST['Kd_ORMA'];
        // print_r($post);

        $select = "SELECT s.*, p.*, k.*, d.Periode_th_akad, d.Kd_ORMA, d.Bipeks_total, l.Total_Pemasukan ";
        $from   = "FROM sik s LEFT JOIN lpj l ON s.No_SIK = l.No_SIK, proposal p, kegiatan k, dana_bipeks d ";
        $where  = "WHERE s.No_proposal = p.No_proposal AND p.Kd_kegiatan = k.Kd_kegiatan AND k.Kd_bipeks = d.Kd_bipeks";
        $total  = $select.$from.$where;
        $query  = mysqli_query($connection, $total);

        $result = array();
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_array($query)) {
                array_push($result, $row);
            }
        }
        $json = json_encode($result, true);
        // print_r($json);
    }

?>


	<div class="jumbotron" style="margin-top: 20px">
		<div class="container text-justify">
			<h2>LAPORAN PERIODE</h2>
		</div>

	</div>	<!-- Akhir dari Jumbotron -->


	<div class="text-right">
		<button class="btn btn-primary" id="Print">Print</button>
    </div>

	<table class="table table-hover">
    <thead>
        <tr class="info">
            <th>NO</th>
            <th>Nama Organisasi</th>
            <th>Nama Kegiatan</th>
			<th>Nomor Proposal</th>
			<th>Nomor SIK</th>
			<th>Tanggal SIK</th>
			<th>Bipekstur Terprogram</th>
            <th>Bipekstur Sisa</th>
            <!-- <th>Action</th> -->
        </tr>
    </thead>
    <tbody>
<?php   for($i = 0; $i < count($result); $i++) { ?>
<?php       $item = $result[$i]; ?>
        <tr class="danger">
            <td><?php echo $i+1; ?></td>
            <td><?php echo $item['Kd_ORMA']; ?></td>
            <td><?php echo $item['Nama_kegiatan']; ?></td>
			<td><?php echo $item['No_proposal']; ?></td>
			<td><?php echo $item['No_SIK']; ?></td>
			<td><?php echo $item['Tgl_SIK']; ?></td>
			<td><?php echo $item['Bipeks_terprogram']; ?></td>
<?php   $bipeks_total = $item['Bipeks_total']; ?>
<?php   $total_pemasukan = $item['Total_Pemasukan']; ?>
<?php   $bipeks_sisa = $bipeks_total - $total_pemasukan; ?>
            <td><?php echo $bipeks_sisa; ?></td>
        </tr>
<?php   } ?>
    </tbody>
</table>

<?php include ("adminfooter.php") ?>

<?php
mysqli_close($connection);
ob_end_flush();
?>
<script>
	$(document).ready(function() {
		$("#Print").click(function() {
			print_d();
		});
	});
	function print_d(){
		window.print();
	}
</script>

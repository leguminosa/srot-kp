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
if(isset($_GET['Kd_ORMA'])) {
	$cari = $_GET["Kd_ORMA"];
	//print_r($cari);
	
	$query_cari = mysqli_query($connection, "SELECT dana_bipeks.Bipeks_total, Kd_ORMA, Kd_bipeks, bipeks_sisa, Periode_th_akad
FROM `dana_bipeks` WHERE Kd_ORMA LIKE '%$cari%'");
//	print_r($query_cari);
		
	
		
/** Memasukkan data fullname ke dalam tabel PelaksanaanSeminar**/
     //mysqli_query($connection, "INSERT INTO dana_bipeks VALUES ('$Kd_bipeks','$Bipeks_total',
	// '$Periode_th_akad','$Kd_ORMA','$Bipeks_total')"); 
//     header("location:danabipeks.php");
}

$query = mysqli_query($connection, "SELECT Bipeks_total FROM dana_bipeks");
$Periode_th_akadquery = mysqli_query ($connection, "SELECT Periode_th_akad FROM tahunakad");
$sisa_dana = mysqli_query($connection, "SELECT dana_bipeks.Bipeks_total, Kd_ORMA, Kd_bipeks, bipeks_sisa, Periode_th_akad
FROM `dana_bipeks`");
$dana_terpakai = mysqli_query($connection,"select sum(Bipeks_terprogram),Kd_kegiatan from proposal group by (Kd_kegiatan)");
//$cari = mysqli_query($connection, "select * from dana_bipeks left join orma on dana_bipeks.Kd_ORMA = orma.Kd_ORMA");
?>	


	<div class="jumbotron" style="margin-top: 20px">
		<div class="container text-justify">
			<h2>DANA BIPEKSTUR KESELURUHAN</h2>			
	</div>
			
	</div>	<!-- Akhir dari Jumbotron -->
	
	
	<table class="table table-hover">
		<div class="etri-form">	
			
		</div>
		
	<tr class="info" height="-50px" style="margin-top: -20px">
				<th>NO</th>
				<th>Kode ORMA</th>
				<th>Total Bipeks</th>
				<th>Kode Bipeks</th>
				<th>Dana Sisa</th>
				<th>Periode</th>
				
				
	</tr>


	<?php
		/** Memeriksa apakah data yang dipanggil tersebut tersedia atau tidak **/
		if(isset($_GET['Kd_ORMA'])) {
		
		if(mysqli_num_rows($query_cari)>0) {
			$no=1;
			while ($row_cari = mysqli_fetch_array($query_cari)) {
				?>
				<tr class="danger" height="20px"style="margin-top: -20px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row_cari['Kd_ORMA']; ?> </td>
					<td><?php echo $row_cari['Bipeks_total']; ?> </td>
					<td><?php echo $row_cari['Kd_bipeks']; ?> </td>
					<td><?php echo $row_cari['bipeks_sisa'] ?> </td>
					<td><?php echo $row_cari['Periode_th_akad'] ?> </td>
					
				</tr>
				<?php $no++; ?> 
				<?php
		}}
		} else if(mysqli_num_rows($query)>0) 
	{?>
		<?php $no=1; ?>
		<?php while ($row = mysqli_fetch_array($sisa_dana)) 
			{ $row2 = mysqli_fetch_array($dana_terpakai)?>
				<tr class="danger" height="-20px"style="margin-top: -20px">
					<td><?php echo $no; ?></td>
					<td><?php echo $row['Kd_ORMA']; ?> </td>
					<td><?php echo $row['Bipeks_total']; ?> </td>
					<td><?php echo $row['Kd_bipeks']; ?> </td>
					<td><?php echo $row['bipeks_sisa'] ?> </td>
					<td><?php echo $row['Periode_th_akad'] ?> </td>
					
				</tr>
				<?php $no++; ?> 
			<?php  } ?>
	<?php  } ?>
	
	
	
	</table>
	
<?php include ("adminfooter.php") ?>

<?php
mysqli_close($connection);
ob_end_flush();
?>
<div><script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script></div>
			
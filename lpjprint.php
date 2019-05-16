<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
    if(isset($_GET['lpjprint'])) {
		$id = $_GET['lpjprint'];
		$get = <<<EOD
		SELECT 	d.*, k.Bipeks_terprogram, o.Nama_ORMA, o.Nama_ketua, l.Sisa_selisih
		FROM 	detaillpj d, lpj l, sik s, proposal p, kegiatan k, dana_bipeks b, orma o
		WHERE 	d.No_LPJ = l.No_LPJ AND
				l.No_SIK = s.No_SIK AND
				s.No_proposal = p.No_proposal AND
				p.Kd_kegiatan = k.Kd_kegiatan AND
				k.Kd_bipeks = b.Kd_bipeks AND
				b.Kd_ORMA = o.Kd_ORMA AND
				d.No_LPJ = '$id'
		ORDER BY d.Kd_detailLPJ ASC
EOD;
		$query = mysqli_query($connection, $get);
		$lpj = array();
		// print_r(mysqli_num_rows($query)); die();
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query)) {
				// print_r(json_encode($row, true));
				$content = array();
				foreach($row as $key=>$value) {
					if(!is_numeric($key)) {
						$content[$key] = $value;
					}
				}
				array_push($lpj, $content);
			}
		}
		// $lpj = json_encode($lpj, true);
		//print_r($lpj);
//		$temb =
//		$query_tem = mysqli_query($connection, $temb);

    }

?>

<?php
	function num2alpha($n) {
		for($r = ""; $n >= 0; $n = intval($n / 26) - 1)
		$r = chr($n%26 + 0x41) . $r;
		return $r;
	}
?>
<style>
	p.alinea {
		padding-left:70px;
		}
	#ukuran {
		font-size: 15px;
	}
</style>
<?php include("adminmenu.php") ?>
<div class="jumbotron" style="margin-top: -50px">
		<div class="container text-justify">
		<?php //print_r($lpj); ?>
		<br></br>
			<center><h4><b>LAPORAN PERTANGGUNGJAWABAN UANG MUKA</h4></b></center>
			<center><h4><b>Periode : 2018</h4></b></center>
			<br></br>

<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
</style>
</head>
<body>

<table style="width=100%">

<tr>
	<th>No.*)</th>
    <td width=25%></td>
</tr>
<tr>
	<th>Tanggal</th>
    <td></td>
</tr>
<tr>
	<th>Rujukan Permintaan Uang muka</th>
    <td></td>
</tr>
<tr>
	<th>No</th>
    <td></td>
</tr>
<tr>
	<th>Tanggal</th>
    <td></td>
</tr>

</table>
</body>
</html>

<br></br>

<table style="width:100%">
  <tr>
    <th><center>Kode Pembukuan *)</th></center>
  </tr>
  <tr>
</table>
<table style="width:100%">

    <td width="25%"><center>Status Akutansi</td></center>
    <td width="25%"><center>Pusat Kegiatan</td></center>
    <td width="25%"><center>Jenis Data</td></center>
    <td width="25%"><center>Proyek</td></center>
  </tr>
</table>

<table>

	<table style="width:100%">
  <tr>
	<td height="40px"> </td>
    <td> </td>
	<td> </td>
	<td> </td>
  </tr>
</table>

</body>
</html>

<p><h5>Nama Pemohon : Admawa</p></h5>
<p><h5>Biro/UPT : </p></h5>

<table style="width:100%">
	<thead>
		<tr>
			<th width="30px"><center>No.</th></center>
			<th><center>Penjelasan</th></center>
			<th colspan="2"><center>Jumlah</th></center>
		</tr>
	</thead>
	<tbody>
<?php for($i = 0; $i < count($lpj); $i++) { ?>
<?php 	$item = $lpj[$i]; ?>
<?php 	//print_r($item); ?>
<?php 	$ket = $item['Keterangan_detailLPJ']; ?>
<?php 	if($ket == 'Pemasukan') { ?>
	<tr>
		<td><center><?php echo num2alpha($i); ?></td></center>
		<td><?php echo $item['Nama_detailLPJ']; ?></td>
		<td colspan="2">Rp.<?php echo $item['Nominal']; ?></td>
	</tr>
<?php 	} ?>
<?php } ?>
	</tbody>

<tr>
	<td><center><?php echo num2alpha(count($lpj)); ?></td></center>
	<th>Uraian Pengeluaran :</th>
	<td colspan="2"></td>
</tr>

<tr>
	<th><center> </th></center>
	<th>Kode Akun</th>
	<th colspan="2">Penjelasan</th>
</tr>

<tbody>
<?php for($i = 0; $i < count($lpj); $i++) { ?>
<?php 	$item = $lpj[$i]; ?>
<?php 	//print_r($item); ?>
<?php 	$ket = $item['Keterangan_detailLPJ']; ?>
<?php 	if($ket == 'Pengeluaran') { ?>
<tr>
	<td><center><?php echo num2alpha($i); ?></td></center>
	<td></td>
	<td><?php echo $item['Nama_detailLPJ']; ?></td>
	<td>Rp.<?php echo $item['Nominal']; ?></td>
</tr>
<?php 	} ?>
<?php } ?>
</tbody>

<tr>
	<td><center><?php echo num2alpha(count($lpj)+1); ?></td></center>
	<td>Tidak ada selisih atau selisih lebih/kurang</td>
	<td colspan="2">Rp.<?php echo $item['Sisa_selisih']; ?></td>
</tr>
</table>

<p>*) Diisi oleh Bagian Keuangan </p>
<p> Catatan : </p>

<table style="width:100%">
<tr>
    <th><center>Pemakai Uang Muka</th></center>
    <th><center>Mengetahui : </th></center>
    <th><center>Disetujui oleh, Direktur</th></center>
</tr>

<tr>
	<td><center>Ketua Umum <br> <?php echo $lpj[0]["Nama_ORMA"]?> <br></br><br><br> <b><u><?php echo $lpj[0]["Nama_ketua"]?></b></u></td></center>
	<td><center><br>Kabag.Admawa<br><br><br><br><br><br><b><u>Sugiyanto</br></br></b></u></td></center>
	<td><center><br><br><br><br><br><u><b>Dr.Adianto,M.Sc</td></center></u></b>
</tr>
	</div>
</div>
	<?php include("adminfooter.php") ?>


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

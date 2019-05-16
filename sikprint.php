<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
    if(isset($_GET['sikprint'])) {
		$id = $_GET['sikprint'];
		$get = <<<EOD
		SELECT 	sik.*, proposal.*, kegiatan.Waktu_pelaksanaan, kegiatan.Ketua_pelaksana, dana_bipeks.Periode_th_akad, orma.Nama_ORMA, orma.Nama_ketua, orma.NIM_ketua
		FROM 	sik, proposal, kegiatan, dana_bipeks, orma
		WHERE 	sik.No_proposal = proposal.No_proposal AND
				proposal.Kd_kegiatan = kegiatan.Kd_kegiatan AND
				kegiatan.Kd_bipeks = dana_bipeks.Kd_bipeks AND
				dana_bipeks.Kd_ORMA = orma.Kd_ORMA AND
				No_SIK = '$id'
EOD;
		$query = mysqli_query($connection, $get);
		$sik = array();
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);
			foreach($row as $key=>$value) {
				if(!is_numeric($key)) {
					$sik[$key] = $value;
				}
			}
//			$row = json_encode($row, true);
//			print_r($row);
		}
		$temb = "SELECT tembusan.Nama_Tembusan FROM sik_tembusan, tembusan WHERE sik_tembusan.Kd_Tembusan = tembusan.Kd_Tembusan AND sik_tembusan.No_SIK = '$id'";
		$query_tem = mysqli_query($connection, $temb);
		
    }
 
?>	
<style>
	p.alinea {
		padding-left:70px;
		}
	#ukuran {
		font-size: 15px;
	#ukuran1 {
		font-size: 16px;
	}
	#paragrap {
		margin-right: 100px;
	}
	
</style>
<?php include("adminmenu.php") ?>

<?php

	$bulan = array(
		'Jan' => 'Januari',
		'Feb' => 'Februari',
		'Mar' => 'Maret',
		'Apr' => 'April',
		'May' => 'Mei',
		'Jun' => 'Juni',
		'Jul' => 'Juli',
		'Aug' => 'Agustus',
		'Sep' => 'September',
		'Oct' => 'Oktober',
		'Nov' => 'November',
		'Dec' => 'Desember'
	);
	$format = 'j M Y';

	$tgl_masuk_proposal = $sik["Tgl_masuk_proposal"];
	$tgl_masuk_proposal = tanggalRapi($tgl_masuk_proposal, $format, $bulan);
	$tgl_pelaksanaan = $sik["Tgl_pelaksanaan"];
	$tgl_pelaksanaan = tanggalRapi($tgl_pelaksanaan, $format, $bulan);
	$Tgl_SIK = $sik["Tgl_SIK"];
	$Tgl_SIK = tanggalRapi($Tgl_SIK, $format, $bulan);
	
	function tanggalRapi($tgl, $format, $bulan) {
		$hasil = date($format, strtotime($tgl));
		$bln = date('M', strtotime($tgl));
		$hasil = str_replace($bln, $bulan[$bln], $hasil);
		return $hasil;
	}
?>

<div class="jumbotron" style="margin-top: -50px">
		<div class="container text-justify">
		<?php //print_r($sik); ?>
			
			<center><h2 id="ukuran1" style="margin-top: 150px"><u>SURAT IZIN KEGIATAN</u></h2></center>
			<center><h2 id="ukuran">Nomor : <?php echo $sik['No_SIK']; ?></h2></center>
			<br>
			<p id="ukuran" style="margin-top: -20px">Setelah mempelajari proposal kegiatan <?php echo $sik["Nama_kegiatan"]?> 
			periode <?php echo $sik["Periode_th_akad"]?> <?php echo $sik["Nama_ORMA"]?>
			Nomor: <?php echo $sik["No_proposal"]?>, tanggal <?php echo $tgl_masuk_proposal; ?>  
			perihal <?php echo $sik["Perihal"]?>, maka dengan ini Direktur Kemahasiswaan dan Alumni Universitas Tarumanagara pada
			prinsipnya memberikan izin kegiatan kepada UKM <?php echo $sik["Nama_ORMA"]?> Universitas Tarumanagara mengadakan :</p> 
			<p class="alinea" id="ukuran">
				Nama Kegiatan : <?php echo $sik["Nama_kegiatan"]?><br>
				Penanggung Jawab : <?php echo $sik["Nama_ketua"]?> / NPM <?php echo $sik["NIM_ketua"]?> <br>
								( Ketua Umum <?php echo $sik["Nama_ORMA"]?>) <br>
				Ketua Pelaksana : <?php echo $sik["Ketua_pelaksana"]?><br>
				Waktu Pelaksana : <?php echo $tgl_pelaksanaan; ?><br>
				Tempat Pelaksana : <?php echo $sik["Tempat_pelaksanaan"]?><br> <br>
			</p>
			<p id="ukuran">Demi menjaga nama baik Universitas Tarumanagara, harap kegiatan dilaksanakan dengan tertib sesuai dengan peraturan/ketentuan yang berlaku,
			serta tidak menggangu hasil belajar. Apabila dalam pelaksanaannya Panatia melanggar ketentuan yang telah ditentukan, akan dikenakan sanksi sesuai dengan peraturan yang berlaku</p>
			<p id="ukuran">Selanjutnya dalam waktu selambat-lambatnya 30(tiga puluh) hari setelah selesai kegiatan, 
			Ketua Pelaksana wajib melaporkan pelaksanaan kegiatan dan keuangan yang mencangkup penerimaan dan pengeluaran kepada Wakil Rektor Bidang Kemahasiswaan (CD foto-foto kegiatan).
			</p>
			<p id="ukuran">Demikian surat ijin kegiatan ini diberikan untuk digunakan sesuai dengan keperluan, dengan catatan surat ijin kegiatan akan batal dengan sendirinya,
			apabila ada ketentuan lain dari yang berwajib.
			</p><br>
			
			<p id="ukuran">Direktur Kemahasiswaan dan Alumni </p>
			<br>
			<br>
			<br>
			<p id="ukuran"><u>Dr. Andianto, M.Sc</u><br>
			<id="ukuran">Direktur</p>
			<br>
			<p id="ukuran"><?php echo $Tgl_SIK; ?>  </p>

<?php	if(mysqli_num_rows($query_tem) > 0) { ?>
<?php		$no = 1; ?>
			<p id="ukuran">Tembusan :</p>
<?php		while($tembus = mysqli_fetch_array($query_tem)) { ?>
			<id="ukuran"><?php echo $no; ?>. <?php echo $tembus["Nama_Tembusan"]?><br>
<?php			$no++; ?>
<?php		} ?>
<?php	} ?>
			
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

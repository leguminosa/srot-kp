
<?php
	include "includes/config.php";
	
	if (isset($_POST['Simpan']))
	{
		if (isset($REQUEST["beritaKode"]))
		{
			$beritaKODE = $_REQUEST["beritaKode"];
		}
		if (!empty("beritaKode"))
		{
			$beritaKODE = $_POST["beritaKode"];
		}
		$beritaJUDUL = $_POST['beritaJudul'];
		$kategoriberitaKODE = $_POST ['kategoriberitakode'] ;
		$kegiatanKODE = $_POST ['kegiatanKode'];
		$kabupatenKODE = $_POST ['kabupatenkode'];
		$beritaISI = $_POST ['beritaIsi'];
		$beritaISI2 = $_POST ['beritaIsi2'];
		
		$nama = $_FILES['file']['name']; /**untuk menampung data foto atau gambar **/
		$file_tmp = $_FILES["file"]["tmp_name"];
		move_uploaded_file($file_tmp, 'images/iconberita/'.$nama); /**untuk upload file gambarnya **/
		
		mysqli_query($connection, "INSERT INTO berita VALUES ('$beritaKODE','$beritaJUDUL
		','$kategoriberitaKODE','$kegiatanKODE','$kabupatenKODE','$beritaISI','$beritaISI2
		','','','','$nama')");
		
	}
	$beritaquery = mysqli_query($connection, "SELECT * FROM berita");
	$katberitaquery = mysqli_query($connection, "SELECT * FROM kategoriberita ORDER BY kategoriberitaKODE ASC");
	$kegiatanquery = mysqli_query($connection, "SELECT * FROM kegiatan ORDER BY eventKODE ASC");
	$kabupatenquery = mysqli_query($connection, "SELECT * FROM kabupaten ORDER BY kabupatenKODE ASC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pesona Jawa</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$( function() {
    $( "#datepicker" ).datepicker({
	dateFormat: "dd-mm-yy",
	changeMonth: true,
	changeYear: true});
  } );
	</script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
	<div class="col-sm-2">
	<h1> INI UNTUK MENU VERTIKAL </h1>
	</div>
	
	<div class="etri-form">
	<h1><b>ENTRI DATA BERITA PESONA JAWA</b></h1>
	</div>
	
	<div class="col-sm-10">
	<form method="POST" class="form-horizontal" enctype="multipart/form-data">
	
		<div class="form-group">		
			
			<label class="col-sm-2 control-label" for="beritaKode">Kode Berita</label>
			<div class="col-sm-2">
			<input class="form-control" type="text" id="beritaKode" name="beritaKode"
			placeholder="Kode Berita"
			maxlength="6" required="">
			</div>
			
			<label class="col-sm-2 control-label" for="beritaJudul">Judul Berita</label>
			<div class="col-sm-2">
			<input class="form-control" type="text" id="beritaJudul" name="beritaJudul"
			placeholder="Judul Berita">
			</div>
			
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="kategoriberitakode">Kategori Berita</label>
			<div class="col-sm-2">
			<select name="kategoriberitakode" class="form-control">
			<option value="kategoriberitaKode">NULL</option>
			<?php if (mysqli_num_rows($katberitaquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($katberitaquery)) {?>
					<option> 
						<?php echo $row["kategoriberitaKODE"]?>
						<?php echo $row["kategoriberitaNAMA"]?>
					</option>
				<?php } ?>
			<?php } ?>
			
			</select>
			</div>
			
			<label class="col-sm-2 control-label" for="kegiatanKode">Nama Kegiatan</label>
			<div class="col-sm-2">
			<select name="kegiatanKode" class="form-control">
			<option value="kegiatanKode">NULL</option>
			<?php if (mysqli_num_rows($kegiatanquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($kegiatanquery)) {?>
					<option> 
						<?php echo $row["eventKODE"]?>
						<?php echo $row["eventNAMA"]?>
					</option>
				<?php } ?>
			<?php } ?>
			
			</select>
			</div>
			
			
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="kabupatenkode">Kode Kabupaten</label>
			<div class="col-sm-2">
			<select name="kabupatenkode" class="form-control">
			<option value="kabupatenkode">NULL</option>
			<?php if (mysqli_num_rows($kabupatenquery)> 0) {?>
				<?php while ($row=mysqli_fetch_array($kabupatenquery)) {?>
					<option> 
						<?php echo $row["kabupatenKODE"]?>
						<?php echo $row["kabupatenNAMA"]?>
					</option>
				<?php } ?>
			<?php } ?>
			
			</select>
			</div>
		</div>
		
		<div class="form-group">		
			
			<label class="col-sm-2 control-label" for="beritaIsi">Isi Berita Paragraf 1</label>
			<div class="col-sm-9">
			<textarea class="form-control" rows="4" type="text" id="beritaIsi"
			name="beritaIsi" placeholder ="Uraikan Berita Secara Lengkap Paragraf 1">
			</textarea>
			</div>			
			
		</div>
		
		<div class="form-group">		
			
			<label class="col-sm-2 control-label" for="beritaIsi2">Isi Berita Paragraf 2</label>
			<div class="col-sm-9">
			<textarea class="form-control" rows="4" type="text" id="beritaIsi2"
			name="beritaIsi2" placeholder ="Uraikan Berita Secara Lengkap Paragraf 2">
			</textarea>
			</div>			
			
		</div>
		<!-- untuk sumber berita -->
		
		<div class="form-group">		
			
			<label class="col-sm-2 control-label" for="datepicker">Tanggal Berita</label>
			<div class="col-sm-2">
			<input class="form-control" type="text" id="datepicker" name="beritaTanggal"
			placeholder="YYYY-MM-DD">			
			</div>
		</div>
		
			<div class="form-group">
			<label class="col-sm-2 control-label" for="file">Foto Icon Berita</label>
			<div class="col-sm-8">
			<input type="file" id="file" name="file">
			<p class="help-block">Field ini digunakan untuk mengambil file/gambar/foto ICON berita</p>
			</div>
			</div>
			
			<div class="col-sm-2">
			</div>
			<div class="col-sm-4">
			<input class="btn btn-default btn-primary" type="submit" value="Simpan" name="Simpan">
			<input class="btn btn-default btn-info" type="reset" value="Batal">
			</div>
			
	</form>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
  </body>
</html>
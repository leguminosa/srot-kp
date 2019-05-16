<?php

include "includes/config.php";

if(isset($_POST['Simpan']))
{
    $kategoriKODE = $_POST['KategoriKode'];
    $kategoriNAMA = $_POST['KategoriNama'];
    $kategoriKET = $_POST['KategoriKet'];
    $kategoriREF = $_POST['KategoriRef'];   


mysqli_query($connection, "INSERT INTO kategoriwisata VALUES ('$kategoriKODE','$kategoriNAMA','$kategoriKET','$kategoriREF')");
header("location:KategoriWisata.php");
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  <!-- membuat form input -->
    
    <div class="col-sm-2">
    <h3>UNTUK MENU VERTICAL</h3> 
    </div>
    
    <div class="col-sm-10">
    
    <form class="form-horizontal" method="POST">
  <div class="form-group form-group">
    <label class="col-sm-3 control-label" for="KategoriKode">Kode Kategori</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" id="KategoriKode" name="KategoriKode" placeholder="Kode Kabupaten">
    </div>
  </div>
  
  
  <div class="form-group form-group">
    <label class="col-sm-3 control-label" for="KategoriNama">Nama Kategori Wisata</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" id="KategoriNama" name="KategoriNama" placeholder="Nama Kategori">
    </div>
  </div>
  
  
  
  <div class="form-group form-group">
    <label class="col-sm-3 control-label" for="KategoriKet">Ket Kategori Wisata</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" id="KategoriKet" name="KategoriKet" placeholder="Ket Kategori">
    </div>
  </div>
  
  
  <div class="form-group form-group">
    <label class="col-sm-3 control-label" for="KategoriRef">Referensi Kategori Wisata</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" id="KategoriRef" name="KategoriRef" placeholder="Referensi Kategori">
    </div>
  </div>
  
  <div class="col-sm-3">
  </div>
  <div class="col-sm-3">
  
  <input class="btn btn-default btn-primary" type="submit" value="Simpan" name="Simpan">
  <input class="btn btn-default btn-info" type="reset" value="Batal">
  </div>
  
  </form>
  </div> <!-- penutup col-sm-10 -->
  
  <!-- akhir form input -->
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
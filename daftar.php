<?php   
    include "includes/config.php";
?>

<?php
        // $query = "SELECT * FROM provinsi";
        // $query = mysqli_query($connection, $query);
        // if(mysqli_num_rows($query) > 0) {
        //     $result = array();
        //     while($row = mysqli_fetch_array($query)) {
        //         $content = array();
        //         $content['id'] = $row['id'];
        //         $content['nama'] = $row['nama'];
        //         array_push($result, $content);
        //     }
        // }
    if(isset($_POST["submit_daftar"])) {
        $Nama = $_POST["nama"];
        $Email = $_POST["usr"];
        $Password = $_POST["pw"];
        $query = "INSERT INTO user (nama_user, email_user, password, keterangan) VALUES ('$Nama', '$Email', '$Password', '')";
        $create_user = mysqli_query($connection, $query);
		$_SESSION['admin_KODE'] = mysqli_insert_id($connection);
		$_SESSION['admin_EMAIL'] = $Email;
		$_SESSION['admin_NAMA'] = $Nama;
		$_SESSION['usertype'] = "";
        header("location:indexADMIN.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title></title>

<!-- Loading CSS... -->
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- <link href="assets/images/dvb.ico" rel="shortcut icon"> -->
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <form class="form-horizontal" id="action" action="daftar.php" method="POST" enctype="multipart/form-data">
                <h2 class="form-signin-heading judul">DAFTAR</h2>
                <!-- <h5 class="judul">Silahkan masuk</h5><br> -->
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Nama</label>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required="" autofocus="" />
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Jenis Kelamin</label>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 radio-group">
                            <input type="radio" value="L" name="jk" checked /> <span>Laki-laki</span>
                            <input type="radio" value="P" name="jk" /> <span>Perempuan</span>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Email</label>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <input type="text" class="form-control" name="usr" placeholder="Email" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Password</label>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <input type="password" class="form-control pass" name="pw" placeholder="Maksimal 15 karakter" required="" maxlength="15" />
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Pastikan Password</label>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <input type="password" class="form-control pass" placeholder="Pastikan sama dengan password di atas" required="" maxlength="15" />
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <button class="btn btn-lg btn-primary" type="submit" name="submit_daftar" value="Daftar" style="float:left;">Daftar</button>
                        <a href="login.php" class="btn btn-lg btn-info" role="button" style="float:left;">Kembali</a>
                    </div>
                </div>
                <br>
                <!-- <a href="daftar.php" role="button"><h5 class="judul">Belum punya akun? Daftar disini</h5></a> -->
            </form>
        </div>
    </div>

<!-- Loading Javascripts... -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/plugins/jquery/3.3.1/js/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/plugins/select2/select2.min.js"></script>
    <script src="assets/plugins/daterangepicker/moment.min.js"></script>
	<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/plugins/waves/waves.min.js"></script>
    <script src="assets/js/terra.js"></script>

    <!-- Loading Core... -->
<?php   $uri = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>
<?php   $uri = $uri == 'malaria' ? 'index' : basename($uri, '.php'); ?>
    <script type="text/javascript" src="<?php echo $uri; ?>.js"></script>
</body>
</html>

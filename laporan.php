
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin_EMAIL']))
	header("location:loginADMIN.php");

include "includes/config.php";
/** Mengecek apakah tombol simpan sudah di pilih/klik atau belum **/
     if(isset($_POST['Simpan']))
 	 {
		if (isset($_REQUEST["No_SIK"]))
			{	$No_SIK = $_REQUEST["No_SIK"];
			}
		if (!empty($No_SIK))
			{	$No_SIK = $_POST['No_SIK'];
			}
		$Tgl_SIK = $_POST['Tgl_SIK'];
		$Perihal= $_POST['Perihal'];
		$No_proposal= $_POST['No_proposal'];


/** Memasukkan data fullname ke dalam tabel universitas**/
     mysqli_query($connection, "INSERT INTO sik VALUES ('$No_SIK',
	 '$Tgl_SIK','$Perihal','$No_proposal')");
     header("location:sik.php");
     }

	 $query = mysqli_query($connection, "SELECT * FROM sik");
	


?>



<?php include("adminmenu.php") ?>

	<div class="etri-form" style="margin-top: -15px";>
		<h1><b>LAPORAN</h1><br>

	</div>

<div class="row">
	<div class="col-sm-12">
		

	<table class="table table-hover">
		

		<div>
            <form class="navbar-form navbar-right" action="siklaporan.php" method="POST">
                <div class="form-group">
                    <!-- <div class="col-lg-8 col-lg-8 col-lg-8 col-lg-8"></div> -->
                    <div class="col-lg-4 col-lg-4 col-lg-4 col-lg-4" style="float:left;">
                        <input type="text" class="form-control" name="Kd_ORMA" placeholder="Search Tahun Akad">
                    </div>
                </div>
				<button type="submit" value="cari" class="btn btn-default" style="float:left;">Submit</button>
				<!-- <a href="printhome.php" style="float:right;">Print</a> -->
			</form>
        </div>
	<!-- membuat judul -->
	
	<?php
		/** Memeriksa apakah data yang dipanggil tersebut tersedia atau tidak **/
		if(mysqli_num_rows($query)>0)
	{?>
		<?php $no=1; ?>
		<?php while ($row = mysqli_fetch_array($query))
			{ ?>
				<tr class="danger" height="20px">
					
				</tr>
				<?php $no++; ?>
			<?php  } ?>
	<?php  } ?>
	</table>
	</div>
</div>


<?php include("adminfooter.php") ?>


<?php
mysqli_close($connection);
ob_end_flush();

?>
<?php
session_start();
$_SESSION['admin_KODE'];
$_SESSION['admin_NAMA'];

unset($_session['admin_KODE']);
unset($_session['admin_NAMA']);

session_unset();
session_destroy();

header("location:loginADMIN.php");
?>
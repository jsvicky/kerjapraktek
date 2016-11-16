<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
 echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

  include "../../../config/koneksi.php";
  include "../../../config/fungsi_thumb.php";

  $halamane=$_GET[halamane];
  $act=$_GET[act];

  // Update Logo
  if ($halamane=='logo' AND $act=='update'){
    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $nama_file   = $_FILES['fupload']['name'];

    UploadLogo($nama_file);
    
    mysql_query("UPDATE logo SET gambar = '$nama_file' WHERE id_logo = '$_POST[id]'");
    
    header('location:../../main.php?halamane='.$halamane);
  }
}
?>

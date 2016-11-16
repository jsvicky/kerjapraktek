<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$halamane=$_GET[halamane];
$act=$_GET[act];


// Update carabeli
if ($halamane=='carabeli' AND $act=='update'){
  $carabeli_seo = seo_title($_POST['nama_carabeli']);
  mysql_query("UPDATE carabeli SET nama_carabeli = '$_POST[nama_carabeli]', carabeli_seo='$carabeli_seo' WHERE id_carabeli = '$_POST[id]'");
  header('location:../../main.php?halamane=carabeli&act=editcarabeli&id=63');
}
}
?>

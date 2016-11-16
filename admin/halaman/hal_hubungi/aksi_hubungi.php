<?php
include "../../../config/koneksi.php";

$halamane=$_GET[halamane];
$act=$_GET[act];

// Hapus hubungi
if ($halamane=='hubungi' AND $act=='hapus'){
  mysql_query("DELETE FROM hubungi WHERE id_hubungi='$_GET[id]'");
  header('location:../../main.php?halamane='.$halamane);
}
?>

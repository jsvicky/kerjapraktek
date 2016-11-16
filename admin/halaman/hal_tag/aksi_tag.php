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

// Hapus Tag
if ($halamane=='tag' AND $act=='hapus'){
  mysql_query("DELETE FROM tag WHERE id_tag='$_GET[id]'");
  header('location:../../main.php?halamane='.$halamane);
}

// Input tag
elseif ($halamane=='tag' AND $act=='input'){
  $tag_seo = seo_title($_POST['nama_tag']);
  mysql_query("INSERT INTO tag(nama_tag,
  username,
  tag_seo) VALUES('$_POST[nama_tag]',
  '$_SESSION[namauser]',
  '$tag_seo')");
  header('location:../../main.php?halamane='.$halamane);
}

// Update tag
elseif ($halamane=='tag' AND $act=='update'){
  $tag_seo = seo_title($_POST['nama_tag']);
  mysql_query("UPDATE tag SET nama_tag = '$_POST[nama_tag]', tag_seo='$tag_seo' WHERE id_tag = '$_POST[id]'");
  header('location:../../main.php?halamane='.$halamane);
}
}
?>

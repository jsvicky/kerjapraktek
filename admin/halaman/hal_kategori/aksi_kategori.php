<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$halamane=$_GET[halamane];
$act=$_GET[act];

// Hapus Kategori
if ($halamane=='kategori' AND $act=='hapus'){
  mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
  header('location:../../main.php?halamane='.$halamane);
}

// Input kategori
elseif ($halamane=='kategori' AND $act=='input'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  
  mysql_query("INSERT INTO kategori
  (nama_kategori,
  username,
  kategori_seo) 
  
  VALUES(
  '$_POST[nama_kategori]',
  '$_SESSION[namauser]',
  '$kategori_seo')");
   
  header('location:../../main.php?halamane='.$halamane);
}

// Update kategori
elseif ($halamane=='kategori' AND $act=='update'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  mysql_query("UPDATE kategori SET nama_kategori='$_POST[nama_kategori]', kategori_seo='$kategori_seo', aktif='$_POST[aktif]' 
               WHERE id_kategori = '$_POST[id]'");
  header('location:../../main.php?halamane='.$halamane);
}

?>

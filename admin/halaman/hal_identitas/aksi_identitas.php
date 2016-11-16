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

// Update identitas
if ($halamane=='identitas' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadFavicon($nama_file);
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[nama_website]',
	                                         email   = '$_POST[email]',
	                                       url       = '$_POST[url]',
										  facebook   = '$_POST[facebook]',
										   rekening  = '$_POST[rekening]',
								      no_telp        = '$_POST[no_telp]',  
                                      meta_deskripsi = '$_POST[meta_deskripsi]',
                                      meta_keyword   = '$_POST[meta_keyword]',
                                      favicon        = '$nama_file'    
                                WHERE id_identitas   = '$_POST[id]'");
  }
  else{
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[nama_website]',
	                                   email   = '$_POST[email]',
	                                        url       = '$_POST[url]',
										  facebook   = '$_POST[facebook]',
										   rekening  = '$_POST[rekening]',
								      no_telp        = '$_POST[no_telp]',  
                                      meta_deskripsi = '$_POST[meta_deskripsi]',
                                      meta_keyword   = '$_POST[meta_keyword]'
                                WHERE id_identitas   = '$_POST[id]'");
  }
  header('location:../../main.php?halamane='.$halamane);
}
}
?>

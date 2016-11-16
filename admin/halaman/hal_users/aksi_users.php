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

// Input user
if ($halamane=='user' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  $pass=md5($_POST[password]);
  
  // Apabila ada foto yang diupload
  if (!empty($lokasi_file)){
    UploadUser($nama_file_unik);
  mysql_query("INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,
								 foto,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
								'$nama_file_unik',
                                '$pass')");
 
  header('location:../../main.php?halamane='.$halamane);
  }
  else{
  mysql_query("INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
                                '$pass')");
 
  header('location:../../main.php?halamane='.$halamane);
}
}

// Update user
elseif ($halamane=='user' AND $act=='update') {
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  // Apabila foto tidak diganti
  if($_POST[password]!=''){
  $pass=md5($_POST[password]);
  if (empty($lokasi_file)){
    mysql_query("UPDATE users SET password        = '$pass',
								  nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  id_session     = '$_POST[id]'");
 
  header('location:../../main.php?halamane='.$halamane);
  }
  // Apabila password diubah
  else{
	$data_foto = mysql_query("SELECT foto FROM users WHERE id_session='$_POST[id]'");
	$r    	= mysql_fetch_array($data_foto);
	@unlink('../../../foto_banner/'.$r['foto']);
	@unlink('../../../foto_banner/'.'small_'.$r['foto']);
    UploadUser($nama_file_unik ,'../../../foto_banner/');
    mysql_query("UPDATE users SET password        = '$pass',
                                  nama_lengkap    = '$_POST[nama_lengkap]',
                                  email           = '$_POST[email]', 
								  foto          = '$nama_file_unik', 
                                  no_telp         = '$_POST[no_telp]'  
                            WHERE id_session      = '$_POST[id]'");
  
  }
  } else {
  if (empty($lokasi_file)){
  mysql_query("UPDATE users SET   nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  id_session     = '$_POST[id]'");
  
header('location:../../main.php?halamane='.$halamane);
  }
  // Apabila password diubah
  else{
	$data_foto = mysql_query("SELECT foto FROM users WHERE id_session='$_POST[id]'");
	$r    	= mysql_fetch_array($data_foto);
	@unlink('../../../foto_banner/'.$r['foto']);
	@unlink('../../../foto_banner/'.'small_'.$r['foto']);
    UploadUser($nama_file_unik ,'../../../foto_banner/');
    mysql_query("UPDATE users SET nama_lengkap    = '$_POST[nama_lengkap]',
                                  email           = '$_POST[email]',
								  foto          = '$nama_file_unik', 
                                  no_telp         = '$_POST[no_telp]'  
                            WHERE id_session      = '$_POST[id]'");
  $mod=count($_POST['halaman']);
  $halaman=$_POST['halaman'];
  for($i=0;$i<$mod;$i++){
  	mysql_query("INSERT INTO users_halaman SET id_session='$_POST[id]',id_halaman='$halaman[$i]'");
  }
  }
  }
  header('location:../../main.php?halamane='.$halamane);
}


 //hapus halamane
elseif($halamane=='user' AND $act=='hapushalamane'){
$id=abs((int)$_GET['id']);
mysql_query("DELETE FROM users_halaman WHERE id_umod=$id");
header('location:../../main.php?halamane='.$halamane.'&act=edituser&id='.$_GET[sessid]);
}

}
?>

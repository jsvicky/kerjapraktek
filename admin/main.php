<?php
session_start();
error_reporting(0);

//fungsi cek akses user
function user_akses($mod,$id){
	$link = "?halamane=".$mod;
	$cek = mysql_num_rows(mysql_query("SELECT * FROM halaman,users_halaman WHERE halaman.id_halaman=users_halaman.id_halaman AND users_halaman.id_session='$id' AND halaman.link='$link'"));
	return $cek;
}
//fungsi cek akses menu
function umenu_akses($link,$id){
	$cek = mysql_num_rows(mysql_query("SELECT * FROM halaman,users_halaman WHERE halaman.id_halaman=users_halaman.id_halaman AND users_halaman.id_session='$id' AND halaman.link='$link'"));
	return $cek;
}
//fungsi redirect
function akses_salah(){
	$pesan = "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Maaf Anda tidak berhak mengakses halaman ini</center>";
 	$pesan.= "<meta http-equiv='refresh' content='2;url=main.php?halamane=home'>";
	return $pesan;
}

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

  echo "
  <link href='css/style.css' rel='stylesheet' type='text/css'>";

  echo "<h1>AKSES GAGAL</h1>
  <p>
  Maaf, untuk masuk Halaman Administrator
  anda harus Login dahulu!</p><br/>
  
  <a href='index.php'><b>LOGIN DI SINI</b></a>";
  
}
else{
?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator CV.VD Production</title>

<link href="halaman/validasi/style_validasi.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="halaman/validasi/sixgha.js"></script>
<script type="text/javascript" src="halaman/validasi/sixgha-validation.js"></script>

<link rel="stylesheet" href="style.css" />
<style type="text/css">
body {
	background-color:#C00;
}


#wrapper{
	width: 1000px;
	margin: 15px auto;
	height: auto;
	padding: 20px;
	background-color:#FFF;
	box-shadow: 0px 0px 20px #F60;
	-moz-box-shadow: 0px 0px 20px #F60;
	-webkit-box-shadow: 0px 0px 20px #F60;
	border-radius: 17px;
	-webkit-border-radius: 17px;
}

.Area_Halaman {
	margin-left: 10px;
	margin-right: 10px;
	margin-bottom: 5px;
	margin-top: 10px;
}
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
</style>
</head>
<div id="wrapper">
<body>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <th scope="col"><img src="img/header menu.png" width="950" height="100" /></th>
  </tr>

	<tr>
	  <td>
	  <hr color="#FDD442" />
	  <?php
	   if ($_GET['halamane']=='home'){
	   echo"<center><h1>Selamat Datang, $_SESSION[namalengkap]...</h1>Silahkan kelola website anda dengan menu yang disediakan</center>";
	   }
	   else{
	  ?>
	  <?php include "menu_atas.php" ?>
	 <?php } ?>
	  <hr color="#FDD442" /></td>
    </tr>
	<tr>
	<td>
<table width="900" border="0" align="center" cellpadding="4" cellspacing="1">
  	
  <tr>
    <td height="525" align="left" valign="top"><div class="Area_Halaman"><?php include "content.php" ?></div></td>
  </tr>
  <tr>
    <td><img src="img/footer menu.png" width="950" height="25" /></td>
  </tr>
</table>
 
</body>
</div>
</html>



  <?php
  }
  ?>
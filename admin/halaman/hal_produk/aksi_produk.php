<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='../../css/zalstyle.css' rel='stylesheet' type='text/css'>
  <link rel='shortcut icon' href='../../favicon.png' />
  
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  <img src='../../img/lock.png'>
  <h1>halaman TIDAK DAPAT DIAKSES</h1>
  <p><span class style=\"font-size:14px; color:#ccc;\">Untuk mengakses halaman, Anda harus login dahulu!</p></span><br/>
  </section>
  <section id='error-text'>
  <p><a class='button' href='../../index.php'> <b>LOGIN DI SINI</b> </a></p>
  </section>
  </div>";}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$halamane=$_GET['halamane'];
$act=$_GET['act'];

// Hapus produk
if ($halamane=='produk' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gbr_produk FROM produk WHERE id_produk='$_GET[id]'"));
  if ($data['gbr_produk']!=''){
     mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
     unlink("../../../img_produk/$_GET[namafile]");   
     unlink("../../../img_produk/kecil_$_GET[namafile]");   
	 
  }
  else{
     mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
  }
  header('location:../../main.php?halamane=produk');

}

// Input produk
elseif ($halamane=='produk' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

 $produk_seo = seo_title($_POST['jdl_produk']);
 

 
  
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
   // Uploadproduk($nama_file_unik);
	UploadProduk($nama_file_unik,'../../../img_produk/',300,120);

     mysql_query("INSERT INTO produk(id_kategori,
								    jdl_produk,
                                    produk_seo,
							        keterangan,
									tag,
								    username,
								    tgl_posting,
								    jam,
									hari,
                                    gbr_produk,
									harga,
									diskon,
									stok) 
                            VALUES('$_POST[kategori]',
								   '$_POST[jdl_produk]',
                                   '$produk_seo',
								   '$_POST[keterangan]',
								   '$_POST[tag]',
								   '$_SESSION[namauser]',
								   '$tgl_sekarang',
								   '$jam_sekarang',
								   '$hari_ini',
                                   '$nama_file_unik',
								   '$_POST[harga]',
								   '$_POST[diskon]',
								   '$_POST[stok]')");
								   
								   
  header('location:../../main.php?halamane='.$halamane);
  }
  else{
     mysql_query("INSERT INTO produk(id_kategori,
									jdl_produk,
                                    produk_seo,
									username,
								    tgl_posting,
								    jam,
									hari,
									keterangan,
									tag,
									harga,
									diskon,
									stok) 
                            VALUES('$_POST[kategori]',
								   '$_POST[jdl_produk]',
                                   '$produk_seo',
								   '$_SESSION[namauser]',
								   '$tgl_sekarang',
								   '$jam_sekarang',
								   '$hari_ini',
								   '$_POST[keterangan]',
								     '$_POST[tag]',
								   '$_POST[harga]',
								   '$_POST[diskon]',
								   '$_POST[stok]')");
								   
								   
								   
  header('location:../../main.php?halamane='.$halamane);
  }
}

// Update produk
elseif ($halamane=='produk' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  $produk_seo = seo_title($_POST['jdl_produk']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE produk SET id_kategori   = '$_POST[kategori]',
								  jdl_produk     = '$_POST[jdl_produk]',
                                  produk_seo     = '$produk_seo', 
								     keterangan = '$_POST[keterangan]',
									  tag = '$_POST[tag]',
									 
										
										harga	= '$_POST[harga]',
										diskon	= '$_POST[diskon]',
										stok	= '$_POST[stok]'
								 WHERE id_produk = '$_POST[id]'");
							 
							 
							 
  header('location:../../main.php?halamane='.$halamane);
  }
  else{    
    //Uploadproduk($nama_file_unik);
	// Penambahan fitur unlink utk menghapus file yg lama biar gak ngebek-ngebeki server ^_^
	$data_gbr_produk= mysql_query("SELECT gbr_produk FROM produk WHERE id_produk='$_POST[id]'");
	$r    	= mysql_fetch_array($data_gbr_produk);
	@unlink('../../../img_produk/'.$r['gbr_produk']);
	@unlink('../../../img_produk/'.'kecil_'.$r['gbr_produk']);
    UploadProduk($nama_file_unik,'../../../img_produk/',300,120);
	
	 mysql_query("UPDATE produk SET id_kategori= '$_POST[kategori]',
								    jdl_produk = '$_POST[jdl_produk]',
                                    produk_seo = '$produk_seo',
								  keterangan  = '$_POST[keterangan]', 
								  tag  = '$_POST[tag]', 
                                 gbr_produk    = '$nama_file_unik', 
								 aktif 	  =	'$_POST[aktif]',
									harga	  = '$_POST[harga]',
									diskon	  = '$_POST[diskon]',
									stok	  = '$_POST[stok]'						   
							   WHERE id_produk = '$_POST[id]'");
							 
							 
							 
    header('location:../../main.php?halamane='.$halamane);
	}
    
  }

}
?>

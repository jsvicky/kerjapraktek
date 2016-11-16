
<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
</script>



<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

  echo "
  <link href='style.css' rel='stylesheet' type='text/css'>";

  echo "
  </head>
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  
  <img src='img/lock.png'>
  <h1>halaman TIDAK DAPAT DIAKSES</h1>
  
  <p><span class style=\"font-size:14px; color:#ccc;\">Untuk mengakses halaman, Anda harus login dahulu!</p></span><br/>
  
  </section>
  
  <section id='error-text'>
  <p><a class='button' href='index.php'>&nbsp;&nbsp; <b>ULANGI LAGI</b> &nbsp;&nbsp;</a></p>
  </section>
  </div>";
   }
  else{

//cek hak akses user
$cek=user_akses($_GET[halamane],$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){

function GetCheckboxes($table, $key, $Label, $Nilai='') {
  $s = "select * from $table order by nama_tag";
  $t = mysql_query($s);
  $_arrNilai = explode(',', $Nilai);
  $str = '';
  while ($w = mysql_fetch_array($t)) {
    $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';
    $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label] ";
  }
  return $str;
}

$aksi="halaman/hal_produk/aksi_produk.php";
switch($_GET[act]){

//update/////////////////////////////////////

  // Tampil produk
  default:
echo "  <div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <br/>
   <a href='?halamane=produk&act=tambahproduk' class='button'>
   <span>Tambah Produk</span>
   </a></div>";

    if (empty($_GET['kata'])){
echo "
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>DATA PRODUK</h1>
   <span></span> 
   </div>
   <div class='block-content'>		
		
    		  
   <table id='table-example' class='table'>	  
	  
   <thead><tr>	
  
   <th></center>Foto</center></th>
  
   <th>Judul Produk</th>
   <th>Harga</th>
   <th>Diskon</th>
   <th>Stok</th>
   <th>Spesifikasi</th>
   <th>Keterangan</th>
   <th>Aksi</th>
   
    </thead>
    <tbody>";
  

    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC");
    }
   else{
      $tampil=mysql_query("SELECT * FROM produk
                           WHERE produk.id_kategori=kategori.nama_kategori
						   AND username='$_SESSION[namauser]'       
                           ORDER BY id_produk DESC");  
                         
    }
  
    while($r=mysql_fetch_array($tampil)){
	
  echo "<tr class=gradeX> 
   <td width=50><center><img src='../img_produk/kecil_$r[gbr_produk]' width=50></center></td>

   <td>$r[jdl_produk]</td>
   <td>$r[harga]</td>	 
   <td>$r[diskon]</td>	 
   <td>$r[stok]</td>
   	 <td>$r[tag]</td>
	 <td>$r[keterangan]</td>
  <td width=80>
   
  <a href=?halamane=produk&act=editproduk&id=$r[id_produk] title='Edit' class='with-tip'>
  <center><img src='img/edit.png'></a>
  
  <a href=javascript:confirmdelete('$aksi?halamane=produk&act=hapus&id=$r[id_produk]&namafile=$r[gbr_produk]') 
   title='Hapus' class='with-tip'>
   &nbsp;&nbsp;&nbsp;&nbsp;<img src='img/hapus.png'></center></a>
   
  </td></tr>";  
      }
echo "</tbody></table> ";

      if ($_SESSION[leveluser]=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk"));
      }
        else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE username='$_SESSION[namauser]'"));
      }  
      break;    
      }
      else{
echo "   		  
   <table id='table-example' class='table'>	  
	  
   <thead><tr>	
  
   <th></center>Foto</center></th>
   <th>Judul Berita Foto</th>
   <th>Link</th>
   <th>Aksi</th>
   
   
    </thead>
    <tbody>";

      if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM produk WHERE judul LIKE '%$_GET[kata]%' ORDER BY id_produk DESC");
      }
      else{
      $tampil=mysql_query("SELECT * FROM produk 
                           WHERE username='$_SESSION[namauser]'
                           AND judul LIKE '%$_GET[kata]%'       
                           ORDER BY id_produk DESC");
      }
  
      $no = $posisi+1;
      while($r=mysql_fetch_array($tampil)){
	  
  echo "<tr class=gradeX> 
   <td width=50><center><img src='../img_produk/kecil_$r[gbr_produk]' width=50></center></td>
   <td>$r[jdl_produk]</td>
   <td>produk-$r[id_produk]-$r[produk_seo].html</td>
			 
  <td width=80>
   
  <a href=?halamane=produk&act=editproduk&id=$r[id_produk] title='Edit' class='with-tip'>
  <center><img src='img/edit.png'></a></center>
   
  </td></tr>";
  
      $no++;
     }
echo "</tbody></table> ";

      if ($_SESSION[leveluser]=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE jdl_produk LIKE '%$_GET[kata]%'"));
      }
      else{
     $jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE username='$_SESSION[namauser]' AND jdl_produk LIKE '%$_GET[kata]%'"));
      }  
      break;    
      }
	  
//batas update/////////////////////////////////////////////////////////////////////////
	
  // Form Tambah produk
  case "tambahproduk":

   echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>FORM TAMBAH PRODUK</h1>
   </div>
   <div class='block-content'>	
   
   <form id='login' method=POST action='$aksi?halamane=produk&act=input' enctype='multipart/form-data'>
		  
   <p class=inline-small-label> 
   <label for=field4>Judul Produk</label>
   <input type=text name='jdl_produk' class='required' title='Judul Produk harus di isi' >
   </p> 

	<p class=inline-small-label> 
   <label for=field4>Kategori</label>
   <select name='kategori'>
   <option value=0 selected>- Pilih kategori -</option>";
   $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
   while($r=mysql_fetch_array($tampil)){
   echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>  </p> ";}
 
   echo "</select>
   
   <p class=inline-small-label> 
   <label for=field4>Keterangan</label>
   <textarea name='keterangan' style='width: 600px; height: 200px;' class='required' title='Keterangan Produk harus di isi'></textarea>
   </p> 
   
   
   <p class=inline-small-label> 
   <label for=field4>Spesifikasi</label>
   <textarea name='tag' style='width: 720px; height: 200px;'>$r[tag]</textarea>
   </p> 
	
   
   <p class=inline-small-label> 
   <label for=field4>Gambar</label>
   <input type=file name='fupload' size=40>
   </p>";

   	echo" <p class=inline-small-label> 
   <label for=field4>Harga</label>
   <input type=text name='harga' class='required' title='Harga Produk harus di isi'>
   </p> ";
   
   echo" <p class=inline-small-label> 
   <label for=field4>Diskon</label>
   <input type=text name='diskon' size=40>
   </p> ";
   
    echo" <p class=inline-small-label> 
   <label for=field4>Stok</label>
   <input type=text name='stok' class='required' title='Stok Produk harus di isi'>
   </p> ";
   
 
      echo"<br /><br /> <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?halamane=produk'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
	  </li> </ul>
	  </form>";
		  
  break;
  
  // Form Edit produk  
  case "editproduk":
    $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

   echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>FORM EDIT PRODUK</h1>
   </div>
   <div class='block-content'>

    <form method=POST enctype='multipart/form-data' action=$aksi?halamane=produk&act=update>
    <input type=hidden name=id value='$r[id_produk]'>
		  		  
   <p class=inline-small-label> 
   <label for=field4>Judul Produk</label>
   <input type=text name='jdl_produk' value='$r[jdl_produk]' size=40>
   </p> 
	
	 <p class=inline-small-label> 
    <label for=field4>Kategori</label>
    <select name='kategori'>";
    $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
    if ($r[id_kategori]==0){
    echo "<option value=0 selected>- Pilih kategori -</option>";}   
    while($w=mysql_fetch_array($tampil)){
    if ($r[id_kategori]==$w[id_kategori]){
    echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";}
    else{
    echo "<option value=$w[id_kategori]>$w[nama_kategori]</option> </p> "; }}
		  
    echo "</select>
		  
   <p class=inline-small-label> 
   <label for=field4>Keterangan</label>
   <textarea name='keterangan' style='width: 720px; height: 200px;'>$r[keterangan]</textarea>
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>Spesifikasi</label>
   <textarea name='tag' style='width: 720px; height: 200px;'>$r[tag]</textarea>
   </p> 
	
		  
   <p class=inline-small-label> 
   <label for=field4>Gambar</label>
   <img src='../img_produk/kecil_$r[gbr_produk]'>
   </p> 
		  
   <p class=inline-small-label> 
   <label for=field4>Ganti Gambar</label>
  <input type=file name='fupload' size=40>
   </p> ";
	
   
   	echo" <p class=inline-small-label> 
   <label for=field4>Harga</label>
   <input type=text name='harga' value='$r[harga]' size=40>
   </p> ";
   
   echo" <p class=inline-small-label> 
   <label for=field4>Diskon</label>
   <input type=text name='diskon' value='$r[diskon]' size=40>
   </p> ";
   
   echo" <p class=inline-small-label> 
   <label for=field4>Stok</label>
   <input type=text name='stok' value='$r[stok]' size=40>
   </p> ";
   
  
      
    echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?halamane=produk'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
	  </li> </ul>
	  </form>";
	  
	  
    break;  
   }
   //kurawal akhir hak akses halamane
   } else {
	echo akses_salah();
   }
   }
   ?>

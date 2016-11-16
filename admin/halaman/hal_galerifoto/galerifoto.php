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

$aksi="halaman/hal_galerifoto/aksi_galerifoto.php";
switch($_GET[act]){

  // AWAL TAMPIL //////////////////////////
   default:
  
   echo "
   <div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <br/>
   <a href='?halamane=galerifoto&act=tambahgalerifoto' class='button'>
   <span>Tambahkan Foto</span>
   </a></div>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>GALERI FOTO</h1>
   <span></span> 
   </div>
   <div class='block-content'>		
    		  
   <table id='table-example' class='table'>	  
	  
   <thead><tr>	

   <th><center>Foto</center></th>
  
   <th>Produk</th>
   <th>Aksi</th>
   
    </thead>
    <tbody>";
	
    if ($_SESSION['leveluser']=='admin'){
    $tampil = mysql_query("SELECT * FROM gallery,produk WHERE gallery.id_produk=produk.id_produk ORDER BY id_gallery DESC");}
	
    else{
    
    echo "<span class style=\"color:#FAFAFA;\">$_SESSION[namauser]</span>";
    $tampil = mysql_query("SELECT * FROM gallery,produk WHERE gallery.id_produk=produk.id_produk AND  
	gallery.username='$_SESSION[namauser]' ORDER BY id_gallery DESC");}
   
   while($r=mysql_fetch_array($tampil)){
 
   echo "
   <tr class=gradeX> 
   <td width=50><center><img src='../img_galeri/kecil_$r[gbr_gallery]' width=50></center></td>

   <td>$r[jdl_produk]</td>
				
   <td width=80>
   
   <a href=?halamane=galerifoto&act=editgalerifoto&id=$r[id_gallery] title='Edit' class='with-tip'>
   <center><img src='img/edit.png'></a>
   
   <a href=javascript:confirmdelete('$aksi?halamane=galerifoto&act=hapus&id=$r[id_gallery]&namafile=$r[gbr_gallery]') 
   title='Hapus' class='with-tip'>
   &nbsp;&nbsp;&nbsp;&nbsp;<img src='img/hapus.png'></center></a> 
	   
   </td></tr>";
   }
   
   echo "</tbody></table> ";
 
    break;    

  //TAMBAH//////////////////////////

   case "tambahgalerifoto":
 
   echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>TAMBAHKAN FOTO</h1>
   </div>
   <div class='block-content'>	
	
   <form id='login' method=POST action='$aksi?halamane=galerifoto&act=input' enctype='multipart/form-data'>


		  

   <p class=inline-small-label> 
   <label for=field4>Produk</label>
   <select name='produk'>
   <option value=0 selected>- Pilih produk -</option>";
   $tampil=mysql_query("SELECT * FROM produk ORDER BY jdl_produk");
   while($r=mysql_fetch_array($tampil)){
   echo "<option value=$r[id_produk]>$r[jdl_produk]</option>  </p> ";}
 
   echo "</select>
			

   

   <p class=inline-small-label> 
   <label for=field4>Gambar</label>
   <input type=file name='fupload' size=40> 
   </p> 	
		  
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?halamane=galerifoto'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </li> </ul>
  </form>";
   
   break;
    
	// EDIT //////////////////////////
	
    case "editgalerifoto":
	
    $edit = mysql_query("SELECT * FROM gallery WHERE id_gallery='$_GET[id]'");
    $r    = mysql_fetch_array($edit);


   echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>EDIT GALERI FOTO KAMAR DAN FASILITAS</h1>
   </div>
   <div class='block-content'>
	
    <form method=POST enctype='multipart/form-data' action=$aksi?halamane=galerifoto&act=update>
    <input type=hidden name=id value=$r[id_gallery]>
	
  
	   
	   
    <p class=inline-small-label> 
    <label for=field4>Kelas</label>
    <select name='produk'>";
    $tampil=mysql_query("SELECT * FROM produk ORDER BY jdl_produk");
    if ($r[id_produk]==0){
    echo "<option value=0 selected>- Pilih produk -</option>";}   
    while($w=mysql_fetch_array($tampil)){
    if ($r[id_produk]==$w[id_produk]){
    echo "<option value=$w[id_produk] selected>$w[jdl_produk]</option>";}
    else{
    echo "<option value=$w[id_produk]>$w[jdl_produk]</option> </p> "; }}
		  
    echo "</select>
	
  
		  
		  
   <p class=inline-small-label> 
   <label for=field4>Foto</label> ";
    if ($r[gbr_gallery]!=''){
    echo "<img src='../img_galeri/kecil_$r[gbr_gallery]'></p>";  }
		  
   echo "
   <p class=inline-small-label> 
   <label for=field4>Ganti Foto</label>
   <input type=file name='fupload' size=30>  
   </p>		  

      <div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?halamane=galerifoto'>Batal</a>
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


   </div> 
   </div>
   </div>
   <div class='clear height-fix'></div> 
   </div></div>
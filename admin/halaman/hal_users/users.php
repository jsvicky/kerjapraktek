<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
</script>


<?php    
session_start();
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

//cek hak akses user
$cek=user_akses($_GET[halamane],$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){


$aksi="halaman/hal_users/aksi_users.php";
switch($_GET[act]){
  // Tampil User
  default:
echo "";

    if (empty($_GET['kata'])){
	
	
   echo "
     
   <div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <br/>
   <a href='?halamane=user&act=tambahuser' class='button'>
   <span>Tambahkan User</span>
   </a></div>
  
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>MANAJEMEN USER</h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
   <table id='table-example' class='table'>
		  
   <thead><tr>
  
   <th>No.</th> 
   <th>Username</th> 
   <th>Nama Lengkap</th> 
   <th>Email</th>
   <th>Foto</th>
   <th>Blokir</th> 
   <th>Aksi</th>
   </tr> 
   </thead>
   <tbody>";


   if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM users Where username !='admin' ORDER BY id_session DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
    $lebar=strlen($no);
    switch($lebar){
      case 1:
      {
        $g="0".$no;
        break;     
      }
      case 2:
      {
        $g=$no;
        break;     
      }      
    } 
	
   echo "<tr class=gradeX> 
   
   <td width=50><center>$g</center></td>
   <td>$r[username]</td>
   <td>$r[nama_lengkap]</td>
   <td><a href=mailto:$r[email]>$r[email]</a></td>
   <td><center><img src='../foto_user/small_$r[foto]' width=50></center></td>
   <td align=center><center>$r[blokir]</center></td>
   
   <td valign=middle><a href=?halamane=user&act=edituser&id=$r[id_session] rel=tooltip-top title='Edit' class='with-tip'>
   <center><img src='img/edit.png'></center></a> 
   
   </td> </tr> ";
  
    $no++; }
	
   echo "</tbody></table> ";

   break;  }

  
  
   case "tambahuser":
   if ($_SESSION[leveluser]=='admin'){
   echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>TAMBAH USER</h1>
   </div>
   <div class='block-content'>
   
   <form id='login' method=POST action='$aksi?halamane=user&act=input' enctype='multipart/form-data'>
	  
   <p class=inline-small-label> 
   <label for=field4>Username</label>
   <input type=text name='username' class='required' title='Username harus di isi'>
   </p> 
	 	  
   <p class=inline-small-label> 
   <label for=field4>Password</label>
   <input type=text name='password'  class='required' title='Password harus di isi'>
   </p> 

   <p class=inline-small-label> 
   <label for=field4>Nama Lengkap</label>
   <input type=text name='nama_lengkap' class='required' title='Nama Lengkap harus di isi'>
   </p> 
	 	  
   <p class=inline-small-label> 
   <label for=field4>E-mail</label>
   <input type=text name='email' class='required' title='Email harus di isi'>
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>No.Telp/HP</label>
   <input type=text name='no_telp' class='required' title='No.Telp/HP harus di isi'>
   </p> 
   
   <p class=inline-small-label> 
   <span class=label>Upload Foto</span>
   <input type='file' name='fupload' /><br/>
   </p><br/>";
	  

  

    echo "<br/><br/><div class=block-actions> 
    <ul class=actions-right> 
    <li>
    <a class='button red' id=reset-validate-form href='?halamane=user'>Batal</a>
    </li> </ul>
    <ul class=actions-left> 
    <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </form>"; }
	  
	 
    else{
   echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>

   <div class='block-header'>
   <h1>Anda tidak berhak mengakses halaman ini !</h1>
   </div>";  }
	 
   break;
    
   case "edituser":
   $edit=mysql_query("SELECT * FROM users WHERE id_session='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[leveluser]=='admin'){
	
		  
   echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>EDIT USER</h1>
   </div>
   <div class='block-content'>
     
   <form method=POST action='$aksi?halamane=user&act=update' enctype='multipart/form-data'>
   <input type=hidden name=id value=$r[id_session]>
   <input type=hidden name=blokir value='$r[blokir]'>
	  
   <p class=inline-small-label> 
   <label for=field4>Username</label>
   <input type=text name='username' value='$r[username]' disabled>
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>Password</label>
   <input type=text name='password'>
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>Nama Lengkap</label>
   <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'>
   </p> 
	 
   <p class=inline-small-label> 
   <label for=field4>E-mail</label>
   <input type=text name='email' size=30 value='$r[email]'>
   </p> 
	 
   <p class=inline-small-label> 
   <label for=field4>No.Telp/HP</label>
   <input type=text name='no_telp' size=30 value='$r[no_telp]'>
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>Foto</label>
   <img src='../foto_user/small_$r[foto]' width=100>
   </p>   
    
   <p class=inline-small-label> 
   <span class=label>Ganti Foto</span>
   <input type='file' name='fupload' /><br/>
   </p><br/>";
		  
	
    echo "<br/><br/><div class=block-actions> 
    <ul class=actions-right> 
    <li>
    <a class='button red' id=reset-validate-form href='?halamane=user'>Batal</a>
    </li> </ul>
    <ul class=actions-left> 
    <li>
    <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
	</form>";}
	
	
   else {
   
  		  
   echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>EDIT USER</h1>
   </div>
   <div class='block-content'>
     
   <form method=POST action='$aksi?halamane=user&act=update' enctype='multipart/form-data'>
   <input type=hidden name=id value=$r[id_session]>
   <input type=hidden name=blokir value='$r[blokir]'>
	  
   <p class=inline-small-label> 
   <label for=field4>Username</label>
   <input type=text name='username' value='$r[username]' disabled>
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>Password</label>
   <input type=text name='password'>
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>Nama Lengkap</label>
   <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'>
   </p> 
	 
   <p class=inline-small-label> 
   <label for=field4>E-mail</label>
   <input type=text name='email' size=30 value='$r[email]'>
   </p> 
	 
   <p class=inline-small-label> 
   <label for=field4>No.Telp/HP</label>
   <input type=text name='no_telp' size=30 value='$r[no_telp]'>
   </p> 
   
   <p class=inline-small-label> 
   <label for=field4>Foto</label>
   <img src='../foto_user/small_$r[foto]' width=100>
   </p>   
    
   <p class=inline-small-label> 
   <span class=label>Ganti Foto</span>
   <input type='file' name='fupload' /><br/>
   </p><br/>";
   
    echo "<br/><br/><div class=block-actions> 
    <ul class=actions-right> 
    <li>
    <a class='button red' id=reset-validate-form href='?halamane=user'>Batal</a>
    </li> </ul>
    <ul class=actions-left> 
    <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
	</form>";}     
	
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
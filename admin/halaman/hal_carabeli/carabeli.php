 
  <?php
  $aksi="halaman/hal_carabeli/aksi_carabeli.php";
  switch($_GET[act]){
  // Tampil Cara Beli
  default:
    $sql  = mysql_query("SELECT * FROM carabeli LIMIT 1");
    $r    = mysql_fetch_array($sql);

  
   echo "
   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   </div>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>CARA SEWA</h1>
   <span></span> 
   </div>
   <div class='block-content'>
  
    <form method=POST enctype='multipart/form-data' action=$aksi?halamane=carabeli&act=update>
    <input type=hidden name=id value=$r[id_carabeli]>
		  
    
	 
    <p class=inline-small-label> 
    <label for=field4>Cara Sewa</label>
    <input type=text name='carabeli'size=50 value='$r[nama_carabeli]'>
	
    </p> 
      
	  
	 
	
	
    echo "<div class=block-actions> 
      <ul class=actions-right> 
      <li>
      <a class='button red' id=reset-validate-form href='?halamane=carabeli'>Batal</a>
      </li> </ul>
      <ul class=actions-left> 
      <li>
      <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
	  </form>";
	
    break;  
   

  }
  ?>


   </div> 
   </div>
   </div>
   <div class='clear height-fix'></div> 
   </div></div>
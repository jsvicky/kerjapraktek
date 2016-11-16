
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="halaman/order/aksi_order.php";
switch($_GET[act]){
  // Tampil Order
  default:
    echo "
	<div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
                        <h1>Daftar Sewa</h1>      
                   <span></span> 
   </div>";
    echo "<form action=halaman/hal_order/aksi_alldel.php method=POST>";
    echo " <div class='block-content'>
		  
   <table id='table-example' class='table'>	  
	         
  <thead><tr><th>#</th>
  <th>No.Sewa</th>
  <th>Nama Konsumen</th>
  <th>Tgl. Sewa</th>
  <th>Jam</th>
  <th>In</th>
  <th>Out</th>
  <th>Status</th>
  <th>Aksi</th>
  </thead>
   <tbody>";
    $tampil = mysql_query("SELECT * FROM orders Where status_order='$_GET[status]' ORDER BY id_orders ASC");
    $no=0;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_order]);
if($r[dibaca]=='N'){	  
      echo "<tr class=gradeX><td><input type=checkbox name=cek[] value=$r[id_orders] id=id$no></td>
	            <td >$r[id_orders]</td>";
		   $konsumen=mysql_query("select * from kustomer where email='$r[id_kustomer]'");
		   $nama=mysql_fetch_array($konsumen);
           echo"<td><b>$nama[nama_lengkap]</b></td>
				<td><b>$tanggal</b></td>
				<td><b>$r[jam_order]</b></td>
				<td><b>$r[checkin]</b></td>
				<td><b>$r[checkout]</b></td>
                
                <td><b>$r[status_order]</b></td>
		            <td><a href=?halamane=order&act=detailorder&id=$r[id_orders]><b>Baca</b></a>  
		                <a href=$aksi?halamane=order&act=hapus&id=$r[id_orders]><b></b></a></td></tr>";
      $no++;
	  }
	  else {
	   echo "<tr class=gradeX><td><input type=checkbox name=cek[] value=$r[id_orders] id=id$no></td>
	            <td >$r[id_orders]</td>";
		   $konsumen=mysql_query("select * from kustomer where email='$r[id_kustomer]'");
		   $nama=mysql_fetch_array($konsumen);
           echo"<td>$nama[nama_lengkap]</td>
				<td><b>$tanggal</b></td>
				<td><b>$r[jam_order]</b></td>
				<td><b>$r[checkin]</b></td>
				<td><b>$r[checkout]</b></td>
				
				
                <td>$r[status_order]</td>
		            <td><a href=?halamane=order&act=detailorder&id=$r[id_orders]><b>Baca</b></a> 
		                <a href=$aksi?halamane=order&act=hapus&id=$r[id_orders]><b></b></a></td></tr>";
      $no++;}
    }       
    echo "</td></tr></table></form>";
    break;
  
    
  case "detailorder":
    $edit = mysql_query("SELECT * FROM orders WHERE id_orders='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	mysql_query("UPDATE orders SET dibaca='Y' WHERE id_orders='$_GET[id]'");
    $tanggal=tgl_indo($r[tgl_order]);
	
	 if ($r[status_order]=='Baru'){
        $pilihan_status = array('Batal','Disewa');
    }
    elseif ($r[status_order]=='Disewa'){
        $pilihan_status = array('Disewa', 'Dikembalikan');    
    }
	elseif ($r[status_order]=='Dikembalikan'){
        $pilihan_status = array('Dikembalikan');    
    }
    else{
        $pilihan_status = array('Baru', 'Disewa', 'Dikembalikan');    
    }
	
    
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status_order]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

     echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
                        <h1>Sewa Detail</h1>      
                    </div>
   <div class='block-content'>";

    echo "<form method=POST action=$aksi?halamane=order&act=update>
          <input type=hidden name=id value=$r[id_orders]>
          <table  cellpadding='0' cellspacing='0' width='50%' class='table'>
          <tr><td>No. Sewa</td>        <td> : $r[id_orders]</td></tr>
          <tr><td>Tanggal - Waktu Sewa</td> <td> : $tanggal - $r[jam_order]</td></tr>
          <tr><td>Status Sewa      </td><td>: <select name=status_order>$pilihan_order</select></td></tr>
          <tr><td rownspan='2'></td><td> <input class='button red' id=reset-validate-form type='submit' value='Ubah Status'></td></tr>
		  </table>
		 </form>";

  // tampilkan rincian produk yang di order
  
	$tgl_order = tgl_indo($r['tgl_order']); // konversi ke format tanggal indonesia
	$checkin = tgl_indo($r['checkin']); // konversi ke format tanggal indonesia
	$checkout = tgl_indo($r['checkout']); // konversi ke format tanggal indonesia
	
	$selisih = strtotime($r['checkout']) -  strtotime($r['checkin']);
	$hari = ($selisih/(60*60*24))+1;

	
	$item=mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE id_produk='$r[id_tiket]'"));
	$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
	
	$disc     = ($item[diskon]/100)*$item[harga];
	$hargadisc     = number_format(($item[harga]-$disc),0,",",".");
	$hgdisc     = $item[harga]-$disc;
						
	$d=$item['diskon'];
	$htetap="<span>$item[harga]</span>";
	$hdiskon="<span style='text-decoration:line-through;font-size:0.9em'>$item[harga]</span><span></span>";
					  
	if ($d!= "0"){
	$divharga=$hdiskon;
	}else{
	$divharga=$htetap;
	} 
	
	$subtotal    = ($hgdisc*$hari)*$r[jumlah];
	$subtotal_rp=format_rupiah($subtotal);
	$harga=format_rupiah($item['harga']);
	
	$day = date('1', strtotime($checkin)); // konversi ke hari 
	if ($day == "Sunday") $day = "Minggu"; 
	else if ($day == "Monday") $day = "Senin"; 
	else if ($day == "Tuesday") $day = "Selasa"; 
	else if ($day == "Wednesday") $day = "Rabu"; 
	else if ($day == "Thursday") $day = "Kamis"; 
	else if ($day == "Friday") $day = "Jumat"; 
	else if ($day == "Saturday") $day = "Sabtu";
	
	$days = date('l', strtotime($checkout)); // konversi ke hari 
	if ($days == "Sunday") $days = "Minggu"; 
	else if ($days == "Monday") $days = "Senin"; 
	else if ($days == "Tuesday") $days = "Selasa"; 
	else if ($days == "Wednesday") $days = "Rabu"; 
	else if ($days == "Thursday") $days = "Kamis"; 
	else if ($days == "Friday") $days = "Jumat"; 
	else if ($days == "Saturday") $days = "Sabtu";
	
	
  echo "<table border=1 width=500  cellpadding='0' cellspacing='0' width='100%' class='table'>
        <tr><th>Property Name</th><th>Requirements</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
    echo "<tr>
		  <td><b>Property Name: $iden[nama_website]<br/>
			  $item[jdl_produk] Unit<br/></b>
			  $day $checkin – $days $checkout ($hari Hari)<br/>
			  Number of Units: $r[jumlah] Unit</td>
		  <td>$r[jumlah] Unit<br/>$hari Hari</td>
		  <td>"; if ($d!=0){echo"Rp$divharga<br/>";} echo"Rp$hargadisc</td>
		  <td>Rp. $subtotal_rp</td></tr>";
  

     

echo "<tr><td colspan=3 align=right>Grand Total : </td><td>Rp. <b>$subtotal_rp</b></td></tr>
      </table><br/><br/>";

  // tampilkan data kustomer
  $customer=mysql_query("select * from kustomer where id_orders='$r[id_orders]'");
  $c=mysql_fetch_array($customer);
  echo "<table border=0 width=500  cellpadding='0' cellspacing='0' width='100%' class='table'>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr><td>Nama</td><td> : $c[nama_lengkap]</td></tr>
		<tr><td>Identitas</td><td>: $c[identitas]</td></tr>
        <tr><td>Alamat</td><td> : $c[alamat]</td></tr>
        <tr><td>No. Telpon/HP</td><td> : $c[telpon]</td></tr>
        <tr><td>Email</td><td> : $c[email]</td></tr>
        </table>";
    
	 echo "<br/><br/><div class=block-actions> 
    <ul class=actions-right> 
    <li>
    <a class='button red' id=reset-validate-form href='?halamane=order&status=Baru'>Batal</a>
    </li>";
    
  
 }
}
?>

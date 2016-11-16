<div class="banner-in">
		<div class="container">
		<div class="banner-top">
			<h6><a href="index.html">HOME</a> / <span>HISTORI SEWA</span></h6>
		</div>
	</div>
</div>
<div class="contact-non">
					<div class="col-md-12 contact-inline">
				     	<h3>Detail Pemesanan Anda</h3>
 <table class="table table-condensed table-striped">
        <tbody><tr>
          <th>#</th>
          <th>No Sewa</th>
          <th>Unit Name</th>
          <th>Requirements</th>
          <th>Subtotal</th>
          <th>Status</th>
        </tr>
		<?php
		$tampil = mysql_query("SELECT * FROM orders WHERE id_kustomer='$_SESSION[namauser]'");
    $i=1;
	$jumlah = mysql_num_rows($tampil);
	// Apabila ditemukan tiket dalam kategori
	if ($jumlah > 0){
    while($r=mysql_fetch_array($tampil)){
	
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
	
	
	$day = date('l', strtotime($checkin)); // konversi ke hari 
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
	
        echo"<tr>
              <td>$i</td>
              <td>$r[id_orders]</td>
              <td>
			  <b>Property Name: $iden[nama_website]<br/>
			  $item[jdl_produk] Unit<br/></b>
			  $day $checkin – $days $checkout ($hari hari)<br/>
			  Number of Unit: $r[jumlah] Unit
			  </td>
              <td>$r[jumlah] Unit<br/>$hari Hari@<br/>"; if ($d!=0){echo"Rp$divharga<br/>";} echo"Rp$hargadisc</td>
              <td>Rp. $subtotal_rp</td>
              <td>";
			 if ($r['status_order']=='Baru'){echo"<span class='label label-danger'>&nbsp;&nbsp;Baru</span>";}
			 if ($r['status_order']=='Disewa'){echo"<span class='label label-success'>&nbsp;&nbsp;Disewa</span>";} 
			 if ($r['status_order']=='Dikembalikan'){echo"<span class='label label-warning'>&nbsp;&nbsp;Dikembalikan</span>";} 
			 if ($r['status_order']=='Batal'){echo"<span class='label label-primary'>&nbsp;&nbsp;Batal</span>";}
	   echo"</td>
            </tr>";
			$i++;
			}
			}
  else{
    echo "<tr>
		  <td></td>
		  <td colspan=4>Silahkan Ketik kode pemesanan tiket untuk melihat status tiket anda</td></tr>";
  }
			?>
       
            
      </tbody></table>
	  <br/>
	 
				    </div>
					
					<div class="clearfix"> </div>
			</div>
			

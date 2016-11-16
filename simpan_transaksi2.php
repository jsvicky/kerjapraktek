<div class="row">
						<?php						
						$tgl_skrg = date("Ymd");
						$jam_skrg = date("H:i:s");
									  
$id_orders = $_REQUEST['id'];
$sql = mysql_query("select * from orders where id_orders = '$id_orders'");
$data = mysql_fetch_array($sql);
	
 	$value = "Simpan";	//modus input data baru
 	$data['tanggal']=date("Y-m-d");
	//buat kode otomatis
	$query_oto = mysql_query("select max(id_orders)
								as maksi from orders");
	$data_oto = mysql_fetch_array($query_oto);
	$data_potong = substr($data_oto['maksi'],5,5);
	$data_potong++;
	$kode="";
	for ($i=strlen($data_potong); $i<=4; $i++)
		$kode = $kode."0";
	   $data['id_orders'] = "ORD-$kode$data_potong";						



$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM	kustomer WHERE email='$email' AND password='$password'";
$hasil = mysql_query($sql);
$r = mysql_fetch_array($hasil);

if(mysql_num_rows($hasil) == 0){
echo "<script>window.alert('Email atau Password Anda tidak benar')</script>";
 echo "<meta http-equiv='refresh' content='0; url=halaman.php?hal=identitas-pemesan'>";
 
			
}
else{
  session_start();
  $_SESSION[namauser]     = $r[email];
  $_SESSION[namauser]     = $r[email];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser]     = $r[password];

  $sid_lama = session_id();
  session_regenerate_id();
  $sid_baru = session_id();
echo "<script>alert('Selamat Datang $_SESSION[namalengkap]'); window.location = '#'</script>";
	
// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
	$isikeranjang = array();
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
	
	while ($r=mysql_fetch_array($sql)) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

$id = mysql_fetch_array(mysql_query("SELECT email FROM kustomer WHERE email='$email' AND password='$password'"));

// mendapatkan nomor kustomer
$id_kustomer=$id[email];
														
// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);
$sid = session_id();
$tgl=mysql_fetch_array(mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'"));

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders(id_orders,tgl_order,jam_order,id_kustomer,id_tiket,jumlah,checkin,checkout) 
               VALUES('$data[id_orders]',
					  '$tgl_skrg',
					  '$jam_skrg',
					  '$id_kustomer',
					  {$isikeranjang[$i]['id_produk']}, 
					  {$isikeranjang[$i]['jumlah']},
					  '$tgl[startin]',
					  '$tgl[endout]')");
}
  
// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM orders_temp
	  	         WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}


$or=mysql_fetch_array(mysql_query("SELECT * FROM orders WHERE id_orders='$data[id_orders]'"));
// Update untuk mengurangi stok 
     mysql_query("UPDATE produk SET stok=stok-$or[jumlah] WHERE id_produk='$or[id_tiket]'");
	 
      // Update status order
      mysql_query("UPDATE orders SET status_order='Baru' where id_orders='$data[id_orders]'");	
	  

echo"<div class='container'>	
		<div class='four'>		
		  <h1>$data[id_orders]</h1>
		  <p>Mohon simpan kode Penyewaan anda untuk melanjutkan proses andminstrasi pengambilan barang di kantor kami !</p>
		  <form action='halaman.php?hal=status-tiket' method='post' accept-charset='utf-8'>        
		<input name='kode_unik' value='$data[id_orders]' type='hidden'>
		<div class='send-in'>
		 <input name='kode' value='Lihat Status Tiket' type='submit'>
						</div>
						
         
        </form>        <div>&nbsp;</div>
      
		
		    </div>
		</div>";
}
					
				
						
?>
</div>
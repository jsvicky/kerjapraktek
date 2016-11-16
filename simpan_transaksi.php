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



$kar1=strstr($_POST[email], "@");
$kar2=strstr($_POST[email], ".");

// Cek email kustomer di database
$cek_email=mysql_num_rows(mysql_query("SELECT aktif FROM kustomer WHERE aktif='$_POST[aktif]'"));
// Kalau email sudah ada yang pakai
if ($cek_email > 0){
echo "<script>window.alert('Email <b>$_POST[aktif]</b> sudah ada yang pakai.')</script>";
echo "<meta http-equiv='refresh' content='0; url=halaman.php?hal=identitas-pemesan'>";
}
elseif (empty($_POST[nama_pemesan]) || empty($_POST[identitas]) || empty($_POST[alamat]) || empty($_POST[hp]) || empty($_POST[email])){ 
echo "<script>window.alert('Data yang Anda isikan belum lengkap')</script>";
echo "<meta http-equiv='refresh' content='0; url=halaman.php?hal=identitas-pemesan'>";
}
elseif (!ereg("[a-z|A-Z]","$_POST[nama_pemesan]")){
  
echo "<script>window.alert('Nama tidak boleh diisi dengan angka atau simbol.')</script>";
echo "<meta http-equiv='refresh' content='0; url=halaman.php?hal=identitas-pemesan'>";

}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){

echo "<script>window.alert('Data yang anda isikan belum lengkap, silahkan ulangi kembali')</script>";
echo "<meta http-equiv='refresh' content='0; url=halaman.php?hal=identitas-pemesan'>";
 
}
else{

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



function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$nama_pemesan   = antiinjection($_POST['nama_pemesan']);
$hp				= antiinjection($_POST['hp']);
$email			= antiinjection($_POST['email']);
$alamat			= antiinjection($_POST['alamat']);
$identitas		= antiinjection($_POST['identitas']);

// simpan identitas Pemesan
						mysql_query("INSERT INTO kustomer(nama_lengkap,
														  alamat,
														  email,
														  identitas,
														  telpon,
														  id_orders) 
												   VALUES('$nama_pemesan',
														  '$alamat',
														  '$email',
														  '$identitas',
														  '$hp',
														  '$data[id_orders]')");

														
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
					  '$email',
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
		  <p>Mohon catat kode Penyewaan anda untuk melanjutkan proses andminstrasi dan pengambilan barang di kantor kami di:</p>
		  
		  <p>Jalan Benteng Mas I No. No. 69, Jl. Pucuk Beringin I No.69, DKI Jakarta, Daerah Khusus Ibukota Jakarta 14350</p>
		  	  <p>TERIMAKASIH </p>
		  <form action='halaman.php?hal=status-tiket' method='post' accept-charset='utf-8'>        
		<input name='kode_unik' value='$data[id_orders]' type='hidden'>
		
						
         
        </form>        <div>&nbsp;</div>
      
		
		    </div>
		</div>";
}
					
				
						
?>
</div>
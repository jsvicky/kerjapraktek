<?php
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_rupiah.php";
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Transaksi</title>
<style type="text/css">
#logo {
 width: 300px;
 height: 200px;	
 float:left;
}
#judul {
 margin-left : 90px;
 width:900px;
 text-align:center;
}

</style>
</head>

<body>
<?php
$edit = mysql_query("SELECT * FROM logo");
    $r    = mysql_fetch_array($edit);
	echo"<div id='logo'><img src='../logo/$r[gambar]' width='280' height='70'></div>";
?>
<div id="judul">
<br />
<br />
<?php 
$tp=mysql_query("SELECT * FROM identitas");
$x    = mysql_fetch_array($tp);

echo"<font size='+3'>$x[nama_website]</font><br /> 
$x[alamat_website]<br />
Alamat: $x[meta_deskripsi]<br/>
Telp/Hp: $x[no_telp], Email : $x[email]";
?>
<hr size="4" color="#000000" />    
    <h2>LAPORAN DAFTAR SEWA MASUK </h2>
</div>

<center>

	<?php
if($_POST['berdasar'] == "Semua Data"){
	//modus Semua Data
	$sql = "SELECT * FROM orders WHERE status_order='Dikembalikan' OR status_order='Disewa'";
}
else if ($_POST['berdasar'] == "Tanggal"){
	//modus tanggal
	$dari = $_POST['dari'];
	$ke = $_POST['ke'];
	$sql = "SELECT * FROM orders WHERE tgl_order >= '$dari' and tgl_order <= '$ke' AND status_order='Dikembalikan' OR status_order='Disewa'";
}
$query = mysql_query($sql);
?></center>




	<style type="text/css">                       
            @import "halaman/laporan/export/media/css/demo_table_jui.css";
            @import "halaman/laporan/export/media/themes/sunny/jquery-ui-1.8.4.custom.css";
            @import "halaman/laporan/export/extras/TableTools/media/css/TableTools.css";
        </style>      

        <script src="halaman/laporan/export/media/js/jquery.js"></script>
        <script src="halaman/laporan/export/media/js/jquery.dataTables.js"></script>
        <script src="halaman/laporan/export/extras/TableTools/media/js/ZeroClipboard.js"></script>
        <script src="halaman/laporan/export/extras/TableTools/media/js/TableTools.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
				    oTable = $('#contoh').dataTable({      
					     "bJQueryUI": true,
					     "sPaginationType": "full_numbers",
					     "sDom": 'T<"clear">lfrtip',
               "oTableTools": {
                  "sSwfPath": "export/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
              },
               "oLanguage": {
						      "sLengthMenu": "Tampilan _MENU_ data",
						      "sSearch": "Cari: ", 
						      "sZeroRecords": "Tidak ditemukan data yang sesuai",
						      "sInfo": "_START_ sampai _END_ dari _TOTAL_ data",
						      "sInfoEmpty": "0 hingga 0 dari 0 entri",
						      "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
						      "oPaginate": {
						          "sFirst": "Awal",
						          "sLast": "Akhir", 
						          "sPrevious": "Balik", 
						          "sNext": "Lanjut"
					       }
				      }
				    });
          })    
        </script>
    </head>
    <body>
           
                  







<center>
<table id="contoh" class="display">
                <thead>
                    <tr>
         <th>No</th>
        <th>Tgl order</th>
        <th>No order</th>
        <th>Kustomer</th>
        <th>Property Name</th>
		<th>Start in - End Out</th>
        <th>Requirement</th>
        <th>Harga	</th>
        <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
      <?php
			   $i=1;
			  while ($data = mysql_fetch_array($query)){
	$checkin = tgl_indo($data['checkin']); // konversi ke format tanggal indonesia
	$checkout = tgl_indo($data['checkout']); // konversi ke format tanggal indonesia
	$selisih = strtotime($data['checkout']) -  strtotime($data['checkin']);
	$hari = ($selisih/(60*60*24))+1;
	$item=mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE id_produk='$data[id_tiket]'"));
	$kust=mysql_fetch_array(mysql_query("SELECT * FROM kustomer WHERE id_orders='$data[id_orders]'"));
	$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
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
	
	$subtotal    = ($hgdisc*$hari)*$data[jumlah];
	$subtotal_rp=format_rupiah($subtotal);
	$harga=format_rupiah($item['harga']);
	
			  
			echo "<tr bgcolor=white>
              <td align=center>$i</td>
              <td align=center >$data[tgl_order]</td>
              <td align=center >$data[id_orders]</td>
              <td align=center >$kust[nama_lengkap]</td>
              <td align=left >$item[jdl_produk]</td>
              <td align=left >$day $checkin – $days $checkout</td>
              <td>$data[jumlah] Unit x $hari Hari</td>
              <td>"; if ($d!=0){echo"Rp$divharga<br/>";} echo"Rp$hargadisc</td>
              
              <td align=left >Rp.$subtotal_rp</td>
			  </td>
            </tr>";
			$i++;
			}
			?>
     </tbody>
            </table></center>
			</br>
			


	
</body>
</html>


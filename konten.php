<?php
if ($_GET['hal']=='home')
{ include "home.php";}
else
if  ($_GET['hal']=='detailproduk')
{ include "detailproduk.php";}
else
if  ($_GET['hal']=='book')
{ include "book.php";}
else
if  ($_GET['hal']=='booking')
{ include "booking.php";}
else
if  ($_GET['hal']=='simpan-chart')
{ include "simpan_chart.php";}
else
if  ($_GET['hal']=='identitas-pemesan')
{ include "identitas_pemesan.php";}
else
if  ($_GET['hal']=='simpan-transaksi')
{ include "simpan_transaksi.php";}
else
if  ($_GET['hal']=='simpan-transaksi2')
{ include "simpan_transaksi2.php";}
else
if  ($_GET['hal']=='status-tiket')
{ include "status_tiket.php";}
else
if  ($_GET['hal']=='status-histori')
{ include "status_histori.php";}
else
if  ($_GET['hal']=='cara-sewa')
{ include "cara_sewa.php";}
else
if  ($_GET['hal']=='mail')
{ include "mail.php";}
else
if  ($_GET['hal']=='mail-aksi')
{ include "mail_aksi.php";}
else
if  ($_GET['hal']=='produk')
{ include "produk.php";}
else
if  ($_GET['hal']=='produk-kategori')
{ include "produk_kategori.php";}
?>
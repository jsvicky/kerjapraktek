<?php
session_start();
include "../../../config/koneksi.php";

$halamane=$_GET[halamane];
$act=$_GET[act];

if ($halamane=='order' AND $act=='hapus'){
  mysql_query("DELETE FROM orders WHERE id_orders='$_GET[id]'"); 
  header('location:../../main.php?halamane='.$halamane);
 }
elseif ($halamane=='order' AND $act=='update'){
   // Update stok barang saat transaksi sukses (Lunas)
   if ($_POST[status_order]=='Disewa'){ 
    
      // Update status order
      mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");	  
	  header('location:../../main.php?halamane=order&status=Disewa');
	  }
 
elseif($_POST[status_order]=='Dikembalikan'){
	    // Update untuk menambah stok
	    mysql_query("UPDATE produk,orders SET produk.stok=produk.stok+orders.jumlah WHERE produk.id_produk=orders.id_tiket and orders.id_orders='$_POST[id]'"); 
	    mysql_query("UPDATE produk SET stok=stok-$_GET[jml] WHERE id_produk='$_POST[tiket]'");
	 
	    // Update status order Dikembalikan
      mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");

	    header('location:../../main.php?halamane=order&status=Dikembalikan');
	  }
	  
	  //---------------------------
	  elseif($_POST[status_order]=='Batal'){
	    // Update untuk menambah stok
	    mysql_query("UPDATE produk,orders SET produk.stok=produk.stok+orders.jumlah WHERE produk.id_produk=orders.id_tiket and orders.id_orders='$_POST[id]'"); 
	    mysql_query("UPDATE produk SET stok=stok-$_GET[jml] WHERE id_produk='$_POST[tiket]'");
	 
	    // Update status order Batal
      mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");

	    header('location:../../main.php?halamane=order&status=Batal');
	  }
	  
 else{
     mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");
     header('location:../../main.php?halamane=order&status=Baru');
     }
}
?>



<?php
$sid = session_id();
						
						$selisih = strtotime($_POST['checkout']) -  strtotime($_POST['checkin']);
						$hari = ($selisih/(60*60*24))+1;
						
						// put the product in cart table
						mysql_query("INSERT INTO orders_temp (id_produk, id_session, jumlah, startin, endout,lama)
						VALUES ('$_GET[id]','$sid','$_POST[jumlah]','$_POST[checkin]', '$_POST[checkout]','$hari')");

 echo "<meta http-equiv='refresh' content='0; url=halaman.php?hal=identitas-pemesan'>";		
											
?>

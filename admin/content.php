   <style type="text/css">

#main{
	width: 600px;
	margin: 15px auto;
	height: auto;
	padding: 20px;
	background-color:#fff;
	box-shadow: 0px 0px 20px #6D7B8D;
	-moz-box-shadow: 0px 0px 20px #FF6347;
	-webkit-box-shadow: 0px 0px 20px #FF6347;
	border-radius: 17px;
	-webkit-border-radius: 17px;
}

}
</style>
   <?php
   include "../config/koneksi.php";
   include "../config/library.php";
   include "../config/fungsi_indotgl.php";
   include "../config/fungsi_combobox.php";
   include "../config/class_paging.php";
   include "../config/fungsi_rupiah.php";
   // Bagian Home
   if ($_GET['halamane']=='home'){
   if ($_SESSION['leveluser']=='admin'){
   
  ?>
 
  <br/>
  <br/>
  <br/>
 <div id="main">
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
 
  <tr>
    <td height="250" valign="middle"><?php include "menu.php" ?></td>
  </tr>
 
</table>
</div>
  <?php
   
  } 
}


// Bagian Option
elseif ($_GET[halamane]=='order'){
  if ($_SESSION['leveluser']=='admin'){
    include "halaman/order/order.php";
  }
}

// Bagian User
elseif ($_GET['halamane']=='user'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "halaman/hal_users/users.php";
  }
}


// Bagian kategori
elseif ($_GET['halamane']=='kategori'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "halaman/hal_kategori/kategori.php";
  }
}

// Bagian Hubungi Kami
elseif ($_GET['halamane']=='hubungi'){
   if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "halaman/hal_hubungi/hubungi.php";
  }
}

// Bagian produk
elseif ($_GET['halamane']=='produk'){
   if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "halaman/hal_produk/produk.php";
  }
}

// Bagian Galeri Produk
elseif ($_GET['halamane']=='galerifoto'){
   if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "halaman/hal_galerifoto/galerifoto.php";
  }
}



// Bagian Logo
elseif ($_GET[halamane]=='logo'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "halaman/hal_logo/logo.php";
  }
}

// Bagian Identitas Website
elseif ($_GET['halamane']=='identitas'){
   if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "halaman/hal_identitas/identitas.php";
  }
}
// Bagian Laporan Transaksi
elseif ($_GET['halamane']=='laptrans'){
   if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "halaman/laporan/laptrans.php";
  }
}
// Bagian Cara Sewa
elseif ($_GET['halamane']=='carabeli'){
   if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "halaman/hal_carabeli/carabeli.php";
  }
}


// Apabila halaman tidak ditemukan
else{
  echo "<p><b>HALAMAN BELUM ADA ATAU BELUM LENGKAP</b></p>";
}


?>

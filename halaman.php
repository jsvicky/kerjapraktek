<?php 
  error_reporting(0);
  session_start();
  include "config/koneksi.php";
  include "config/fungsi_indotgl.php";
  include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
  include "config/class_paging.php";
  
  ?>
  <?php
    $show=mysql_query("SELECT * FROM identitas WHERE id_identitas='1'");
    $r=mysql_fetch_array($show);
	
	?>
<html>
<head>
<title><?php echo"$r[nama_website]"; ?></title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="shortcut icon" href="foto_logo/favicon.png" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo"$r[meta_keyword]"; ?>" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->
<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>
<!--//fonts-->
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

<!--strat-date-piker-->
					<link rel="stylesheet" href="css/jquery-ui.css" />
					<script src="js/jquery-ui.js"></script>
							  <script>
									  $(function() {
										$( "#datepicker,#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
									  });
							  </script>
					<!--//End-date-piker-->	
	
	
	
	
</head>
<body> 
	<!--header-->	
<div class="header">
	<div class="header-top">
        <div class="container">
		<div class="header-top-top">
			<div class=" header-top-left">
			<?php
 //AUTENTIKASI PEMBERIAN komentar_user BERITA
  
   echo"<p>24/7 Support <span>02129615658 | Sewa Alat Event by VD Production</span></p>";
	
					  ?>
					 		
			</div>
			
  	       
			
			<div class="clearfix"></div>
       </div>
    </div>
	</div>
      <div class="header_bottom"> 
	  <div class="container">
	   <div class="header-bottom-top">
       <div class=" logo">
	   <?php
  $logo=mysql_query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1");
  while($b=mysql_fetch_array($logo)){
    echo "<a href='$link[url]'><img src='logo/$b[gambar]'/></a>";
  }
  ?>
  
   	   
   	   </div>
   
	   	<div class="top-nav">
				<span class="menu"><img src="images/menu.png" alt=""> </span>

     		 		<ul>
					  <li  class="active"><a href="halaman.php?hal=home">Home</a></li>
     		 		  <li><a href="halaman.php?hal=produk">Produk</a></li>
					  <li><a href="halaman.php?hal=cara-sewa">Cara Sewa</a></li>
					  <li><a href="halaman.php?hal=mail">Contact</a></li>
					  <?php
 //AUTENTIKASI PEMBERIAN komentar_user BERITA
   if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
   echo"";
		} else{echo"<li><a href='halaman.php?hal=status-histori'></a></li>";}
					  ?>
					  
					  
     		 		</ul>
					<script>
						$("span.menu").click(function(){
							$(".top-nav ul").slideToggle(500, function(){
							});
						});
					</script>

     		 	</div>

   	  <div class="clearfix"></div>
   	  </div>
	  </div>
	</div>	
</div>
 
   <!---->
<?php include"konten.php";?>
	<div class="footer">
				<div class="container">
				<div class="footer-bottom-at">
				<?php
	echo"<div class='col-md-6 footer-grid'>
						<h3>$r[nama_website]</h3>
						<p>$r[meta_deskripsi]</p>
					</div>";
	?>
					
					<div class="col-md-6 footer-grid-in">
					<ul class="footer-nav">
					 <li  class="active"><a href="halaman.php?hal=home">Home</a></li>
     		 		  <li><a href="halaman.php?hal=produk">Produk</a></li>
					  <li><a href="halaman.php?hal=cara-sewa">Cara Sewa</a></li>
					  <li><a href="halaman.php?hal=mail">Contact</a></li>
					</ul>
					<p class="footer-class"> © 2016 <?php echo"$r[nama_website]"; ?>  <a href="<?php echo"$r[url]"; ?>" target="_blank"><?php echo"$r[url]"; ?></a> </p>
					<p class="footer-class">Web Versi 1.1 </p>
					</div>
					<div class="clearfix"> </div>
				</div>
				</div>
			</div>
</body>
</html>
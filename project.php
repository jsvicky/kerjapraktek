<div class="banner-in">
		<div class="container">
		<div class="banner-top">
			<h6><a href="index.html">HOME</a> / <span>PROJECTS</span></h6>
		</div>
	</div>
</div>	
<!---->
	<div class="project">
			<div class="container">
				
				<div class="project-in ">
					<?php
  $g = mysql_query("SELECT * FROM gallery ORDER BY id_gallery DESC");
  $ada = mysql_num_rows($g);
  if ($ada > 0) {
  $no=1;
  while ($w = mysql_fetch_array($g)) {
  echo"
  <div class='col-md-4 grid_box'>
						<div class='view effect'>
							<a  href='img_galeri/$w[gbr_gallery]' class='b-link-stripe b-animate-go  thickbox swipebox'> 
							<img src='img_galeri/$w[gbr_gallery]' class='img-responsive mike-grid' alt=''><span class='zoom-icon'> </span> </a>
					
						</div>
						<div class='number-top'>
						<span class='number'>$no.</span>
						<div class='number-in'>
							<h6><a href='#'>Lorem ipsum dolor sit amet</a></h6>
							<p>But I must explain to you how all this mistaken idea of denouncing pleasure.</p>
						</div>
						<div class='clearfix'> </div>
					</div>
					</div>"; 
$no++;					
  }


  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM gallery WHERE id_produk='$_GET[id]'"));
  
  }else{
  echo "<div class='blumada2'><h4>Belum ada foto pada halaman ini.</h4></div>";}
  ?>
  
					
					<div class="clearfix"> </div>
				</div>	
				
			</div>
	</div>
	<!---->
	<link rel="stylesheet" href="css/swipebox.css" />
	<script src="js/jquery.swipebox.min.js"></script> 
	    <script type="text/javascript">
			jQuery(function($) {
				$(".swipebox").swipebox();
			});
		</script>

	<!---->
<div class="banner-in">
		<div class="container">
		<div class="banner-top">
			<h6><a href="index.html">HOME</a> / <span>ABOUT</span></h6>
		</div>
	</div>
</div>
<div class="container">	
		<div class="about-top">
		<div class='about-top-top'>	
		
		<?php
  $g = mysql_query("SELECT * FROM gallery WHERE id_produk='$_GET[id]'  ORDER BY id_gallery DESC");
  $ada = mysql_num_rows($g);
  
  if ($ada > 0) {

  while ($w = mysql_fetch_array($g)) {
  
  echo "
					<div class='col-md-6 top-about'>
						<a href='img_galeri/$w[gbr_gallery]'><img class='img-responsive' src='img_galeri/$w[gbr_gallery]' alt=''/></a>
						<div class='simply-in' >
							<h4>$w[jdl_gallery]</h4>
							<p>$w[keterangan]</p>
						</div>

					</div>
					
			";
  
  }


  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM gallery WHERE id_produk='$_GET[id]'"));
  
  }else{
  echo "<div class='blumada2'><h4>Belum ada foto pada halaman ini.</h4></div>";}
  ?>
  
		</div>			
		</div>
	</div>
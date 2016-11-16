<?php $f=mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE produk.id_produk='$_GET[id]'")); 
         mysql_query("UPDATE produk SET hits_produk=$f[hits_produk]+1 WHERE id_produk='$_GET[id]'");
?>	
<div class="banner-in">
		<div class="container">
		<div class="banner-top">
			<h6><a href="index.html">HOME</a> / <span>BOOKING</span></h6>
		</div>
	</div>
</div>
<!--start-booking-->
	<div class="booking">
		<div class="container">
			<div class="booking-main">
				<div class="booking-top">
				<form action='<?php echo"halaman.php?hal=simpan-chart&id=$_GET[id]"; ?>' method='post'>
					<div class="col-md-4 booking-top-left">
						<h4>Book Units Now</h4>
						<br/>
						<div class="pricing-table-grid">
						<?php
						$harga=format_rupiah($f[harga]);
						echo"<div class='plans_head'>
									<h3>$f[jdl_produk]</h3>
								    <h4 class='m_4'><small class='m_2'>Rp</small>$harga<small small class='m_3'>/hari</small></h4>
								    <p>Diskon untuk produk ini adalah $f[diskon]%</p>
								</div>";
						?>
								
				      </div>
						<div class="booking-form">
							<div class="b_room">
								<div class="booking_room">
									<div class="reservation">
										<ul>		
											 <li  class="span1_of_1 left">
											 	<div class="book-text">
												 	<h5>Start in date:</h5>
												 </div>
												 <div class="book_date">
													
													 <input class="date" id="datepicker" type="text" name="checkin" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=>
													 
												 </div>
												 <div class="clearfix"></div>					
											 </li>
											 <li  class="span1_of_1 left">
												 <div class="book-text">
												 	<h5>End out Date:</h5>
												 </div>
												 <div class="book_date">
												 
													<input class="date" id="datepicker1" type="text" name="checkout" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=>
												 
												 </div>
												 <div class="clearfix"></div>		
											 </li>
											  <li class="span1_of_1">
												 <div class="book-text">
												 	<h5>Jumlah Unit</h5>
												 </div>
												 <!--start section_room-->
												 <div class="book_date">
													  <select id="country" name="jumlah" onchange="change_country(this.value)" class="frm-field required" 
															<option value="null"></option>
															<option value="1">1</option>         
														
													  </select>
												 </div>
												 <div class="clearfix"></div>	
											 </li>
											
											 <div class="clearfix"></div>
										</ul>
									 </div>
								</div>
								<div class="clearfix"></div>
							</div>
					<!---->

					<br/>
					
					<div class="send-in">
							<input type="submit" name='btn' value="PESAN">
						</div>
				</div>
					</div>
					</form>
					
							
					<div class="col-md-8 booking-top-right">
						<h4><?php echo"<p>$f[jdl_produk]</p>";?></h4>
						
					  
						<?php
  $g = mysql_query("SELECT * FROM gallery WHERE id_produk='$_GET[id]'  ORDER BY id_gallery DESC");
  $ada = mysql_num_rows($g);
  if ($ada > 0) {
  while ($w = mysql_fetch_array($g)) {
  echo"<div class='book-bottom'>
							<div class='col-md-5 book-bottom-left'>
								<a href='img_galeri/$w[gbr_gallery]'><img class='img-responsive' src='img_galeri/$w[gbr_gallery]' alt=''></a>
							</div>
							<div class='col-md-7 book-bottom-right'>
								<h6><a href='img_galeri/$w[gbr_gallery]'>$w[jdl_gallery]</a></h6>
								<p>$w[keterangan].</p>
							</div>
							<div class='clearfix'></div>
						</div>";
  } 
  }else{
  echo "
  <div class='book-bottom'>
							
							<div class='col-md-7 book-bottom-right'>
								<h6><a href='#'>Mohon maaf belum ada foto produk pada halaman ini.</a></h6>
								</div>
							<div class='clearfix'></div>
						</div>
  ";}
  ?>
  
						
						
						
						<div class="b-bottom">
							<div class="col-md-6 b-bottom-left">
								<h4>Detail Produk Ini</h4>
							<?php
							echo"<p>$f[keterangan]</p>";
							?>	
							
							</div>
							<div class="col-md-6 b-bottom-right">
							
						<h4>Yang Anda dapatkan</h4>
						<ul class="popular">
						<?php 
	
		    $view = mysql_query("SELECT * FROM produk Where id_produk='$_GET[id]'");
			$no=1;
			while($v= mysql_fetch_array($view)){
			$harga=format_rupiah($v['harga']);
			$Nilai=$v['tag'];
			$xxx = explode(',', $Nilai);
			
	$jumlah = count($xxx);
	for($i=0; $i<$jumlah; $i++){
	$urut	= $i+1;
	$nama	= $xxx[$i];
	//jika mau dimasukkan ke databases, silahkan buat query anda disini
		
		 echo"<li><a href='#'><i> </i>$nama</a></li>";
	}
	
						
		
		 
			}?>  </ul>
								</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--end-booking-->
	
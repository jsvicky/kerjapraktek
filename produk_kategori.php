<div class="banner-in">
		<div class="container">
		<div class="banner-top">
			<h6><a href="index.html">HOME</a> / <span>KATEGORI PRODUK</span></h6>
		</div>
	</div>
</div>
	<!---->
<div class="blog">
	<div class="container">
	
	<div class="blog-top">
		<div class="col-md-8 ">
		<?php	
		   $p1     = new PagingProduk;
   $batas  = 10;
   $posisi = $p1->cariPosisi($batas);	
   $produk= mysql_query("SELECT * FROM produk where id_kategori='$_GET[id]' Order by id_produk DESC");
   $no = $posisi+1;
   
  while($w=mysql_fetch_array($produk)){
   $k=mysql_fetch_array(mysql_query("SELECT * FROM kategori WHERE id_kategori='$w[id_kategori]'"));
  $jdl_produk=($w[jdl_produk]);
  
   $keterangan = strip_tags($w['keterangan']); // membuat paragraf pada isi berita dan mengabaikan tag html
                  $isi = substr($keterangan,0,300); // ambil sebanyak 170 karakter
                  $isi = substr($keterangan,0,strrpos($isi," ")); // potong per spasi kalimat
				  
  echo"<div class=' blog_box'>
		        <a href='#'><img src='img_produk/$w[gbr_produk]' alt='image' class='img-responsive'></a>
		     	<h3><a href='#'>$w[jdl_produk]</a></h3>
		     	<div class='links'>
		  		   <p>Rp. <a href='#'>$w[harga]</a>  <a href='#'>$k[diskon]</a> | dilihat: $w[hits_produk] </p>
				    Stok Tersedia $w[stok]
		  		<div class='pricing-table-grid'>";
					if ($w[stok]<=0){echo"<a class='button' href='#'>Barang tidak tersedia</a>";}
					else {echo"<a class='button' href='halaman.php?hal=booking&id=$w[id_produk]'>Booking</a>";}
						
					echo"</div>
					</div>

				</div>";
  }
  
				 
  ?>
  
			
			
		</div>
		<div class="col-md-4 categories-grid">
			
				<div class="grid-categories">
					<h4>Kategori</h4>
					
					<ul class="popular">
					 <?php
				$kategori=mysql_query("select * from kategori");
				while($k=mysql_fetch_array($kategori)){				
          
                  echo "<li><a href='?hal=produk-kategori&id=$k[id_kategori]'><i> </i>$k[nama_kategori]</a></li>";
				}
				  ?>
						
						
					</ul>
				</div>
				
	</div>
				
				
			</div>
			<div class="clearfix"> </div>
			</div>
			<?php
			$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk where id_kategori='$_GET[id]'"));
				  $jmlhalaman  = $p1->jumlahHalaman($jmldata, $batas);
				  $linkHalaman = $p1->navHalaman($_GET[halproduk], $jmlhalaman);
                 
				  echo"<ul class='start'>
					<li>$linkHalaman</li>
					
				</ul>";				  
			?>
			

	 </div>
</div>
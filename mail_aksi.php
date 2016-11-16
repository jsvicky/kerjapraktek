<?php    
mysql_query("INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal) 
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
                               '$_POST[subjek]',
                               '$_POST[pesan]',
                               '$tgl_sekarang')");?>
<div class="banner-in">
		<div class="container">
		<div class="banner-top">
			<h6><a href="index.html">HOME</a> / <span>MAIL</span></h6>
		</div>
	</div>
</div>	
	<!---->
<div class="container">
		<div class="contact">
		<div class=" map">
			<h3>TERIMAKASIH</h3>
			<p>Terima kasih telah menghungi kami</p>
			
			</div>
			
		</div>
	</div>
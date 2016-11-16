<div class="banner-in">
		<div class="container">
		<div class="banner-top">
			<h6><a href="index.html">HOME</a> / <span>CONTACT</span></h6>
		</div>
	</div>
</div>	
	<!---->
<div class="container">
		<div class="contact">
		<div class=" map">
			<h3>LOKASI</h3>
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15867.365032906715!2d106.870818!3d-6.152009!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x827ef72d07a0f170!2sVD+Production!5e0!3m2!1sid!2sid!4v1455388921428" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			
			
			
			</div>
			
			
		  <div class="contact-non">
			  <div class="col-md-6 contact-inline">
				     	<h3>Kunjungi Kami</h3>
	<?php
    $show=mysql_query("SELECT * FROM identitas WHERE id_identitas='1'");
    $r=mysql_fetch_array($show);
	echo"<ul class='social'>
						<li><span><i> </i>$r[meta_deskripsi]</span></li>
						<li><span><i class='down'> </i>$r[no_telp]</span></li>
						<li><a href=''><i class='mes'> </i>$r[email]</a></li>
					</ul>";
					
	?>
	<br />
	<br/>
		<h3></h3>
	<ul class="contact_social">
			  <li><a href="https://facebook.com/vdproduction"> <i > </i> </a></li>
			  <li><a href="https://plus.google.com/101120388306627550810/about"> <i class="gmail"> </i> </a></li>
			  <li><a href="https://twitter.com/vdproduction"> <i class="twitter"> </i></a></li>
			  <li><a href="cs.vdproduction@gmail.com"> <i class="message"> </i></a></li>
			</ul>
		</div>
	

		    </div>
			<div class="col-md-6 contact-grid">
					<h3>Hubungi Kami</h3>
					 <form action='halaman.php?hal=mail-aksi' method='POST'>					
						<input type="text" name='nama' value="Name" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Name';}">
						<input type="text" name='email' value="Email" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Email';}">

						<input type="text" name='subjek' value="Subjek" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Subjek';}">					
						<textarea name='pesan' cols="77" rows="6" value="" onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
						<div class="send-in">
							<input type="submit" value="SUBMIT">
						</div>
					</form>
				</div>
					<div class="clearfix"> </div>
			</div>
		</div>
	</div>
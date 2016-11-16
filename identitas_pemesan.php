<div class="container">
		<div class="contact">
		
		
			<div class="contact-non">
			
			<div class="col-md-5 contact-inline">
				     	<h3>Detail Pemesanan Anda</h3>
						<ul class="social ">
						<b><?php
						$sid = session_id();					
						//$item=mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'"));
		   
	// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
    echo "<script>window.alert('Keranjang Belanjanya Masih Kosong');
        window.location=('index.php')</script>";
    }
  else{
  
   while($item=mysql_fetch_array($sql)){
						$checkin = tgl_indo($item['startin']); // konversi ke format tanggal indonesia
						$checkout = tgl_indo($item['endout']); // konversi ke format tanggal indonesia
						$hari = $item['lama'];
						$harga=format_rupiah($item['harga']);
						
						$disc     = ($item[diskon]/100)*$item[harga];
					    $hargadisc     = number_format(($item[harga]-$disc),0,",",".");
						$hgdisc     = $item[harga]-$disc;
						
						$d=$item['diskon'];
					    $htetap="<span>$item[harga]</span>";
					    $hdiskon="<span style='text-decoration:line-through;font-size:0.5em'>$item[harga]</span><span></span>";
					  
					   if ($d!= "0"){
					   $divharga=$hdiskon;
					   }else{
					   $divharga=$htetap;
					   } 	
						
					   $grandtotal=$hgdisc*$hari*$item[jumlah];
					   $grandtotals=format_rupiah($grandtotal);
											
						echo"<div class='pricing-table-grid'>
								<div class='plans_head'>
									<h3 class='m_4'>$item[jdl_produk]</h3>
								    <h4 class='m_4'><small class='m_2'>Rp";
									if ($d!=0){echo"$divharga";}
									echo"</small>$hargadisc<small small class='m_3'>/hari</small></h4>
								    
								</div>
								<ul>
									<li><span>$day $checkin – $days $checkout <h3 class='m_4'>(Lama Sewa $hari Hari)</h3></span></li>
									<li><span>Jumlah Sewa: <h3 class='m_4'>$item[jumlah] Unit</h3></span></li>
									<li><span>Discount: <h3 class='m_4'>$item[diskon]%</h3></span></li>
									<li><span><h3 class='m_4'>Grand Total: <h1 class='m_4'>Rp. $grandtotals</h1></h3><p>Lama sewa ($hari) x Unit Sewa ($item[jumlah]) x harga ($hgdisc)</p></li>
									
							    </ul>
							  
				      </div>";
					  }
					  }
					  ?></b>

						
					</ul>
					
					
		    
				    </div>
					


				
<div class="col-md-6 contact-grid">
<h3>Identitas Pemesan</h3>
<form method='post' action='halaman.php?hal=simpan-transaksi'>
						<input type="text" name='nama_pemesan' value="Nama" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Silahkan isi nama lengkap anda';}">
						<input type="text" name='email' value="Email" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='isi email anda dengan valid';}">
						<input type="text" name='identitas' value="Identitas & No" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Inputkan Jenis Identitas dan Nomor';}">
						<input type="text" name='hp' value="Nomor Telphone" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Isi Nomer Telphone anda dengan benar';}">					
						<textarea cols="77" rows="6" name='alamat' onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Inputkan Alamat Lengkap Anda mencakup kabupaten/kota dan kodepos sesuai yang tertera di KTP';}">Alamat</textarea>
						<div class="send-in">
							<input type="submit" name='btnSave' value="SUBMIT">
						</div>
    </form>
				</div>
					<div class="clearfix"> </div>
			</div>
		</div>
	</div>










	
	
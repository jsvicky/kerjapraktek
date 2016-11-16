	<div class="content">
			<div class="content-bottom">
	<div class="container">
		<div class="bottom-grid">
		  <h3> Pricing</h3>
		  <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
		</div>
		 <div class="plans">
       	  <?php 
		  
	function GetCheckboxes($table, $key, $Label, $Nilai='') {
			$s = "select * from $table order by nama_tag";
  $t = mysql_query($s);
  $_arrNilai = explode(',', $Nilai);
  $str = '';
  while ($w = mysql_fetch_array($t)) {
    $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';
    $str .= "<li><span><input disabled='disabled' type=checkbox value='$w[$key]' $_ck> &nbsp;$w[$Label]<br/></span></li>";
  }
  return $str;
}

		    $view = mysql_query("SELECT * FROM produk ORDER BY id_produk limit 4");
			while($v= mysql_fetch_array($view)){
			$harga=format_rupiah($v['harga']);
			$Nilai=$v['tag'];
			
			//$array = $v['tag];
			//$v = explode(",", $array); 
			$d = GetCheckboxes('tag', 'tag_seo', 'nama_tag', $v[tag]);
			
			
			
			
			
			
		echo"
			<div class='col-md-3'>
						  <div class='pricing-table-grid'>
								<div class='plans_head'>
									<h3>$v[jdl_produk] </h3>
								    <h4 class='m_4'><small class='m_2'>Rp</small>$harga<small  class='m_3'>/mlm</small></h4>
								    <p>Penawaran :</p>
								</div>
								<ul>
									$d
									
							    </ul>
								<!---->
							    <a class=' button' href='halaman.php?hal=booking&id=$v[id_produk]'>Booking</a>
							   
		         </div>
		     </div>
			";
			}
			
		  ?>        
				   
				   
		    <div class="clearfix"> </div>								
       </div>
       <div class="plans_desc">
        <h3>Want some Customize Plan for your need ?</h3>
        <a class="hvr-shutter-out-vertical" href="mail.html">Contact Us</a>
       </div>
	</div>
</div>

</div>  


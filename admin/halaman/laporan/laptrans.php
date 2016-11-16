<!-- START DATE PICKER STYLES-->
	<link rel="stylesheet" href="picker/development-bundle/themes/ui-lightness/jquery.ui.all.css">
	<script src="halaman/picker/jquery-1.7.1.js"></script>
	<script src="halaman/picker/jquery.ui.core.js"></script>
	<script src="halaman/picker/jquery.ui.datepicker.js"></script>
    
	
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		
	});
	$(function() {
		$( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
	});
	
	
	</script>
	<!-- END DATE PICKER STYLES-->
<center>
<div class='content'>
	   <div class='workplace'>
		<div class='dr'><span></span></div>
            <div class='row-fluid'>
                <div class='span12'>                    
                    
                    <div class='block-fluid table-sorting clearfix'>
	<br/>				

	
    <form method="post" action="report_transaction_view.php">
  	<table width="390" border="1">
	<tr>
    <th scope="col" colspan='2'><h2>LAPORAN TRANSAKSI</h2></th>
    
  </tr>
  <tr>
    <th width="200" scope="col"><input name="berdasar" type="radio" value="Semua Data"  checked /><strong>Semua Data</strong></th>
    <th width="174" scope="col"></th>
  </tr>
  
   <tr bgcolor="#CCCCCC" height="30">
    <th width="200" scope="col"><input name="berdasar" type="radio" value="Tanggal"  checked /><strong>Tanggal Tra</strong></th>
      <th width="174" scope="col"><input name="dari" type="text" id='datepicker' value="Dari" size="12" class="textbox" />
	  <input name="ke" type="text" id='datepicker1' class="textbox" value="Ke" />
	  </th>
      </tr>
	  <tr>
    <th colspan='2' scope="col"></th>
   
  </tr>
  
	  <tr>
    <th colspan='2' scope="col"><input type="submit" name="Submit" class="button" value="Tampilkan" /></th>
  </tr>
</table>

  	<p>&nbsp;</p>
  <p>&nbsp; </p>
  <p>&nbsp;</p>
</form>


<br/>	
 </div>
                </div>                                
            </div>            
            <div class='dr'><span></span></div>            
        </div>
    </div>
	</center>
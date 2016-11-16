<?php
// class paging untuk halaman administrator
class PagingProduk{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halproduk'])){
	$posisi=0;
	$_GET['halproduk']=1;
}
else{
	$posisi = ($_GET['halproduk']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halagenda
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?hal=produk&halproduk=$i>$i</a>";
  }
	  $angka .= " <span>$halaman_aktif</span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?hal=produk&halproduk=$i> $i </a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... <a href=$_SERVER[PHP_SELF]?hal=produk&halproduk=$jmlhalaman>$jmlhalaman</a> " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?hal=produk&halproduk=$next>Next</a>
                     <a href=$_SERVER[PHP_SELF]?hal=produk&halproduk=$jmlhalaman>End</a> ";
}
else{
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?hal=produk&halproduk=$jmlhalaman>Next</a>
                     <a href=$_SERVER[PHP_SELF]?hal=produk&halproduk=$jmlhalaman>End</a> ";
}
return $link_halaman;
}
}


?>

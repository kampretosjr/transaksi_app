<?php 
class transaksi{ 
	function getDataTransaksi($jamban){
		  global $db;
		  $sql = "SELECT tr.id_dompet,kt.nama_kategori,dp.nama_dompet,tr.jumlah_transaksi,tr.keterangan_transaksi,tr.tanggal_transaksi 
		  FROM transaksi as tr 
		  inner join dompet as dp on dp.id_dompet=tr.id_dompet
		  inner join kategori as kt on kt.id_kategori=tr.id_kategori
		  where tr.id_dompet='".$jamban."'
		  ";
		   
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
}

?>
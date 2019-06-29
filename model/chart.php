<?php 
class chart { 
	function diagram(){
		  global $db;
		  $sql = "SELECT month(tr.tanggal_transaksi) AS bulan,
			(select sum(jumlah_transaksi) from transaksi as tr2 
			     INNER JOIN kategori as kg 
			     on kg.id_kategori = tr2.id_kategori
			     INNER JOIN jenis as jn
			     on jn.id_jenis = kg.id_jenis
			where tr2.id_kategori=kg.id_kategori and jn.id_jenis='1' AND month(tr2.tanggal_transaksi) = bulan )as total_pemasukan,

			(select sum(jumlah_transaksi) from transaksi as tr2
			     INNER JOIN kategori as kg 
			     on kg.id_kategori = tr2.id_kategori
			     INNER JOIN jenis as jn
			     on jn.id_jenis = kg.id_jenis
			where tr2.id_kategori=kg.id_kategori and jn.id_jenis='2' AND month(tr2.tanggal_transaksi) = bulan )as total_pengeluaran,

			(SELECT total_pemasukan-total_pengeluaran) as pemasukan_bersih

			FROM transaksi as tr
			GROUP BY month(tr.tanggal_transaksi) ";
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
<?php 
class kategori { 

	function getKategori(){
		  global $db;
		  $sql =  "SELECT kt.nama_kategori,jn.jenis,kt.id_kategori FROM kategori as kt inner join jenis as jn on jn.id_jenis=kt.id_jenis order by kt.id_jenis asc";
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}

	function getDataKategori($where,$order,$limit){
		  global $db;
		  $sql =  "SELECT kt.nama_kategori,jn.jenis,kt.id_kategori FROM kategori as kt inner join jenis as jn on jn.id_jenis=kt.id_jenis 
					".$where."  ".$order.$limit;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}

	function getCountListKategori($where){
		  global $db;
		  $sql = "SELECT kt.id_kategori from kategori as kt inner join jenis as jn on jn.id_jenis=kt.id_jenis

					".$where;
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs->recordCount();
		  }
	}

}
?>
<?php 
class kategori { 
	function getDataKategori(){
		  global $db;
		  $sql = "SELECT kt.id_kategori,kt.nama_kategori,jn.jenis FROM kategori as kt inner join jenis as jn on jn.id_jenis=kt.id_jenis
		  order by kt.id_jenis asc";
		   
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
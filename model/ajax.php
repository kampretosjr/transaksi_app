<?php 
class ajax { 
	function getDataUser($query){
		  global $db;
		  $sql = "SELECT  * from user where nama_lengkap like '%".$query."%'" ;
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
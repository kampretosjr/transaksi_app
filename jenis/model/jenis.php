<?php 
class jenis { 
	function getDataJenis(){
		  global $db;
		  $sql =  " select * from jenis";
		   
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
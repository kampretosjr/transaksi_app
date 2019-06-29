<?php 
class dompet { 
	function getDataDompet(){
		  global $db;
		  $sql =  " select * from dompet";
		   
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
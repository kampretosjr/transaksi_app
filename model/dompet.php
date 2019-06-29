<?php 
class dompet { 
	function getDataDompet($id_user){
		  global $db;
		  $sql =  " select * from dompet WHERE id_user='".$id_user."'";
		   
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getDataDompetbl($where,$order,$limit,$jamban){
		  global $db;
		  $sql =  "SELECT * from dompet
					".$where." and  id_user='".$jamban."'  ".$order.$limit; 
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}

	function getCountListdompet($where,$jamban){
		  global $db;
		  $sql = "SELECT id_dompet,id_user from dompet

					".$where." and  id_user='".$jamban."'";
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
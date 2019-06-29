<?php 
class transaksi{ 
	function getDataTransaksi($where,$order,$limit,$jamban,$id_user){
		  global $db;
		  $sql = "SELECT tr.*,dp.nama_dompet,kt.nama_kategori,jns.jenis 
		  			FROM transaksi as tr
		  			 inner join dompet as dp on dp.id_dompet=tr.id_dompet 
		  			 inner join kategori as kt on tr.id_kategori=kt.id_kategori 
		  			 inner join jenis as jns on jns.id_jenis=kt.id_jenis 
		  			 left outer join user as us on us.id_user=tr.id_user
			   
		  ".$where." and  tr.id_dompet='".$jamban."' and  tr.id_user='".$id_user."' ".$order.$limit; 
	      $rs  = $db->Execute($sql);
		  if(!$rs) {
		  	return $db->ErrorMsg();	
		  }
		  else {
		  	return $rs;
		  }
	}
	function getCountListTransaksi($where,$jamban,$id_user){
		  global $db;
		  $sql = "SELECT tr.id_transaksi,tr.id_dompet FROM transaksi as tr 
		  					 inner join dompet as dp on dp.id_dompet=tr.id_dompet 
				  			 inner join kategori as kt on tr.id_kategori=kt.id_kategori 
				  			 inner join jenis as jns on jns.id_jenis=kt.id_jenis 
				  			 left outer join user as us on us.id_user=tr.id_user
		  						".$where." and  tr.id_dompet='".$jamban."' and  tr.id_user='".$id_user."'";
		 		
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




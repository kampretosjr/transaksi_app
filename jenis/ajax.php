<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();

//Model Global
  include "model/transaksi.php";
  $tr = new transaksi();

//Model Ajax
include "model/ajax.php";
$gen_ajax      = new Ajax();

$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];
}

$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];
}

if($act=="" or $act==null) {
  echo "404 Not Found";
}
else if($act=="getjenis"){
	echo '<option value="">pilih kategori</option>';
	$where_data = array();
	$where_data['id_jenis'] = $_POST['id_ktg'];
									//nama tabel
	$data_jenis = $gen_model->GetWhere('kategori',$where_data);
		while($list = $data_jenis->FetchRow()){
			foreach($list as $key=>$val){
            $key=strtolower($key);
            $$key=$val;
          }  ?>
		<option value="<?php echo $id_jenis ?>"><?php echo $nama_kategori //nama kolom ?></option>
<?php }
}

else if($act=="getdompet"){
			echo "<tr>
                    <th>no.</th>
                    <th>tanggal transaksi</th>
                    <th>jumlah transaksi</th>
                    <th>kategori</th>
                    <th>keterangan transaksi</th>
                    <th>act</th>
                 </tr>";

   $id_dompet  = $_POST['id_dpt'];
									//nama tabel
	$data_transaksi  = $tr->getDataTransaksi($id_dompet);
              $i=1;              
              while($list = $data_transaksi->FetchRow()){
              foreach($list as $key=>$val){
                  $key=strtolower($key);
                  $$key=$val;
                } 
                echo "<tr>
                		  <td>".$i."</td>
                    	  <td>".$tanggal_transaksi."</td>
                    	  <td>".$jumlah_transaksi."</td>
                    	  <td>".$nama_kategori."</td>
                    	  <td>".$keterangan_transaksi."</td>
                    	  <td align='center' >
                      		<a href='".$basepath."./transaksi/edit/".$gen_controller->encrypt($id_transaksi)."'><button class='btn btn-xs btn-warning'>Edit</button></a>
                      		<a href='".$basepath."./transaksi/delete/".$gen_controller->encrypt($id_transaksi)."''><button class='btn btn-xs btn-danger'>Hapus</button></a>
                    	  </td>";
                echo "</tr>";
           	$i++;
					}
}

?>
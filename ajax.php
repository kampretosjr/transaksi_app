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

  include "model/kategori.php";
  $kt = new kategori();

  include "model/dompet.php";
  $dp = new dompet();

//check session
session_start();
if(empty($_SESSION['username'])){
  $gen_controller->redirect('');
}

$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];
}

$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];
      }
//=========================================get jenis================================================================================
if($act=="" or $act==null) {echo "404 Not Found";}
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
  		<option value="<?php echo $id_kategori ?>"><?php echo $nama_kategori //nama kolom ?></option>
      <?php }
      }
//=====================================get dompet=================================================================================
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
                		  <td style='text-align:center;'>".$i."</td>
                    	  <td style='text-align:center;'>".$tanggal_transaksi."</td>
                    	  <td style='text-align:center;'>".$jumlah_transaksi."</td>
                    	  <td style='text-align:center;'>".$nama_kategori."</td>
                    	  <td style='text-align:center;' >".$keterangan_transaksi."</td>
                    	  <td style='text-align:center;' >
                      		<a   href='".$basepath."./transaksi/edit/".$gen_controller->encrypt($id_transaksi)."'><button class='btn btn-xs btn-warning'>Edit</button></a>
                      		<a   href='".$basepath."./transaksi/delete/".$gen_controller->encrypt($id_transaksi)."''><button class='btn btn-xs btn-danger'>Hapus</button></a>
                    	  </td>";
                echo "</tr>";
           	$i++;
					}
        }
  

//======================================DOMPET=================================================================================


else {
  $gen_controller->response_code(http_response_code());
}
?>
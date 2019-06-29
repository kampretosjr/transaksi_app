<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();

//check session
session_start();
if(empty($_SESSION['username'])){
  $gen_controller->redirect('index');
}
//Model Global
  include "model/transaksi.php";
  $tr = new transaksi();

  include "model/kategori.php";
  $kt = new kategori();

  include "model/dompet.php";
  $dp = new dompet();

  include "model/chart.php";
  $md_chart = new chart();

$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];}

$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];}
//==================================================================================================================================
if($act=="" or $act==null) {
  //View
  include "view/header.php";
  include "view/menu.php";
  include "view/dompet.php";
  include "view/footer.php";}
//===================================add===========================================================================================


else if($act=="do_add"){ //add start

  //Proses
  $insert_data = array();
  $insert_data['nama_dompet']      = $_POST['nama_dompet'];
  $insert_data['id_user']            = $_SESSION['id_user'];
  $insert_data['tanggal_buat'] = date("Y-m-d H:i:s");

  if($insert_data['nama_dompet']!=""){
        echo $gen_model->Insert('dompet',$insert_data);
    }
  else {
    $gen_controller->redirect_alert('window_back','Terjadi kesalahan2');
  }
  //add end
}
//=============================delete================================
else if($act=="do_delete"){
  $where_data = array();
  $where_data['id_dompet']  = $gen_controller->decrypt($_POST['id_parameter']);
if(!empty($_SESSION['username'])){ 
    if($gen_model->delete('dompet',$where_data)=="OK"){  
      $gen_model->delete('transaksi',$where_data);

      echo "OK";
      }
    else {echo "Terjadi kesalahan";}
}
else {
  echo 'NOT_LOGIN';
}
}

//hapus end
//======================edit=======================================================================================================
else if($act=="edit" and $id_parameter!=""){
  $edit = $gen_model->GetOneRow('dompet',array('id_dompet'=>$gen_controller->decrypt($id_parameter))); 
    foreach($edit as $key=>$val){
                  $key=strtolower($key);
                  $$key=$val;
    }
    $data = array('total'=>$total,'nama_dompet'=>$nama_dompet,'id_dompet'=>$id_parameter);

    echo json_encode($data);} 

//=====================do=edit=======================================================================================================
else if($act=="do_update"){
  if(!empty($_SESSION['username'])){ 
    
    $update_data = array();                 //name di view
    $update_data['nama_dompet']                  = $_POST['nama_dompet'];
    $update_data['total']                        = $_POST['nominal'];

  //Paramater
    $patokan_parameter = array();
    $patokan_parameter['id_dompet']     = $gen_controller->decrypt($_POST['id_parameter']);

      if ($update_data['nama_dompet']!="") {
        echo $gen_model->update('dompet',$update_data,$patokan_parameter);
      }
      else{ $gen_controller->redirect_alert('window_back','Terjadi1 kesalahan');}

        
  }
  else {
    echo 'NOT_LOGIN';
  }
}
//////////////////////////////////DATATABLE///////////////////////////
else if($act=="list_rest_dp"){
  $where_costum = $_SESSION['id_user'];
  $aColumns = array('nama_dompet','total'); //Kolom Pada Tabel

  // Input method (use $_GET, $_POST or $_REQUEST) jangan di sentuh
  $input =& $_POST;
  $iColumnCount = count($aColumns);

  $sLimit = $gen_controller->Paging($input);
  $sOrder = $gen_controller->Ordering($input, $aColumns );
  $sWhere = $gen_controller->Filtering($aColumns, $iColumnCount, $input);

  $aQueryColumns = array();
  foreach ($aColumns as $col) {
    if ($col != ' ') {
      $aQueryColumns[] = $col;
    }
  }

  $rResult        = $dp->getDataDompetbl($sWhere,$sOrder,$sLimit,$where_costum);
  $rResultFilterTotal   = $dp->getCountListdompet($sWhere,$where_costum);

  $output = array(
    "sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
    "iTotalRecords"        => $rResultFilterTotal,
    "iTotalDisplayRecords" => $rResultFilterTotal,
    "aaData"               => array(),
  );

  while($aRow = $rResult->FetchRow()){
    
    $param_id = $gen_controller->encrypt($aRow['id_dompet']);
    $edit = '<button  data-toggle="modal" data-target="#Modaledit" type="button" onclick="do_edit(\''.$param_id.'\')" class="btn btn-primary btn-xs"><i class="fa fa-pencil m-r-5"></i> Update</button>';
    $delete = '&nbsp; <button type="button" onclick="do_delete(\''.$param_id.'\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o m-r-5"></i> Delete</button>';

    $edit_delete = $edit.$delete;
    $row = array();
    $row = array($aRow['nama_dompet'],
                 $aRow['total'],
                "<center>".$edit_delete."</center>");
    $output['aaData'][] = $row;
  }
  echo json_encode($output);
}

else {
	$gen_controller->response_code(http_response_code());
}
?>
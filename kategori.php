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
  include "view/kategori.php";
  include "view/footer.php";}
//===================================add===========================================================================================
// else if($act=="add"){
//   //Model

//   include "model/kategori.php";
//   include "model/jenis.php";
//   include "model/dompet.php";

//   $kt = new kategori();
//   $jn = new jenis();
//   $dp = new dompet();
   
//   include "view/header.php";  
//   include "view/kategori_add.php";
//   include "view/footer.php";}

else if($act=="do_add"){ //add start

  //Proses
  $insert_data = array();
  $id_jenisnya                            = $_POST['jenis'];

        if($id_jenisnya=="1"){
        $jenis_kategori = "pemasukan";
      }
      else {
        $jenis_kategori = "pengeluaran";
      }

  $insert_data['nama_kategori']      = $_POST['nama_kategori'];
  $insert_data['id_jenis']            = $_POST['jenis'];
  // $insert_data['jenis_kategori']      = $jenis_kategori;
  $insert_data['created_date'] = date("Y-m-d H:i:s");

  if($insert_data['nama_kategori']!=""){
        echo $gen_model->Insert('kategori',$insert_data);
    }
  else {
     $gen_controller->redirect_alert('window_back','Terjadi kesalahan2');
  }
  //add end
}
//=============================delete=======================================================================================
else if($act=="do_delete"){
  //Paramater
  $where_data = array();
  $where_data['id_kategori']      = $gen_controller->decrypt($_POST['id_parameter']);

  //Hapus Foto

  
  //Hapus data     'nama tabel di DB'
  if($gen_model->Delete('kategori',$where_data)=="OK"){
    $gen_controller->redirect_alert('kategori','Data kategori Berhasil di hapus');
  }
  else {
    $gen_controller->redirect_alert('kategori','Terjadi kesalahan');
  }
}
//hapus end
//======================edit=======================================================================================================
else if($act=="edit" and $id_parameter!=""){
 $edit = $gen_model->GetOneRow('kategori',array('id_kategori'=>$gen_controller->decrypt($id_parameter))); 
    foreach($edit as $key=>$val){
                  $key=strtolower($key);
                  $$key=$val;
    }
    $data = array('id_jenis'=>$id_jenis,
                  'nama_kategori'=>$nama_kategori,
                  'id_kategori'=>$id_parameter);

    echo json_encode($data); 
}


//=====================do=edit=======================================================================================================
else if($act=="do_update"){
  if(!empty($_SESSION['username'])){ 
    
    $update_data = array();                 //name di view
    $update_data['nama_kategori']                  = $_POST['nama_kategori'];
    $update_data['id_jenis']                        = $_POST['kontol'];
 
  //Paramater
    $patokan_parameter = array();
    $patokan_parameter['id_kategori']     = $gen_controller->decrypt($_POST['id_parameter']);

      if ($update_data['nama_kategori']!="") {
        echo $gen_model->update('kategori',$update_data,$patokan_parameter);
      }
      else{ $gen_controller->redirect_alert('window_back','Terjadi1 kesalahan');}

        
  }
  else {
    echo 'NOT_LOGIN';
  }
}
//=======================================KATEGORI=================================================================================
  else if($act=="list_rest"){
  $aColumns = array('kt.nama_kategori','jn.jenis','kt.id_kategori'); //Kolom Pada Tabel

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

  $rResult        = $kt->getDataKategori($sWhere,$sOrder,$sLimit);
  $rResultFilterTotal   = $kt->getCountListKategori($sWhere);

  $output = array(
    "sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
    "iTotalRecords"        => $rResultFilterTotal,
    "iTotalDisplayRecords" => $rResultFilterTotal,
    "aaData"               => array(),
  );

  while($aRow = $rResult->FetchRow()){
    
    $param_id = $gen_controller->encrypt($aRow['id_kategori']);
    $edit = '<button  data-toggle="modal" data-target="#Modaledit" type="button" onclick="do_edit(\''.$param_id.'\')" class="btn btn-primary btn-xs"><i class="fa fa-pencil m-r-5"></i> Update</button>';
    $delete = '&nbsp; <button type="button" onclick="do_delete(\''.$param_id.'\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o m-r-5"></i> Delete</button>';
    // $delete = '&nbsp;<a href="'.$basepath.'kategori/delete/'.$param_id.'"> <button type="button" class="btn btn-danger btn-xs"> Delete</button></a>';

    $edit_delete = $edit.$delete;
    $row = array();
    $row = array($aRow['nama_kategori'],
                 $aRow['jenis'],
                "<center>".$edit_delete."</center>");
    $output['aaData'][] = $row;
  }
  echo json_encode($output);
}
else {
	$gen_controller->response_code(http_response_code());
}
?>
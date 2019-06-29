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

$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];
}
//Model Global
  include "model/transaksi.php";
  $tr = new transaksi();

  include "model/kategori.php";
  $kt = new kategori();

  include "model/dompet.php";
  $dp = new dompet();
$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];
}

if($act=="" or $act==null) {


  //View
  include "view/header.php";
  include "view/menu.php";
  include "view/transaksi.php";
  include "view/footer.php";
}
//==========================================================================
else if($act=="add"){
  //Model
  include "model/kategori.php";
  include "model/transaksi.php";
  include "model/dompet.php";

  $tr  = new transaksi();
  $dp = new dompet();
  $kt = new kategori();

  include "view/header.php";  
  include "view/menu.php";
  include "view/transaksi_add.php";
  include "view/footer.php";
}
else if($act=="do_add"){ //add start

$where_id_dompet                  = array();
$where_id_dompet['id_dompet']      = $_POST['dompet'];
//                                                       kolom    nama tabel
$isi_dompet                         = $gen_model->GetOne('total','dompet',$where_id_dompet);
$nominal                            = $_POST['nominal_transaksi'];
$jns_transaksi                      = $_POST['jenis_transaksi'];

if($jns_transaksi=="1"){
  $nominal_new = $isi_dompet+$nominal;
}
else {
  $nominal_new = $isi_dompet-$nominal;
}
  //Proses
  $insert_data = array();
  $insert_data['id_user']           = $_POST['id_user'];
  $insert_data['id_kategori']           = $_POST['kategori'];
  $insert_data['keterangan_transaksi']  = $_POST['keterangan'];
  $insert_data['tanggal_transaksi']     = $_POST['tanggal_transaksi'];
  $insert_data['id_dompet']             = $_POST['dompet'];
  $insert_data['jumlah_transaksi']      = $nominal;
  
 if($insert_data['id_dompet']!=""){
    if($gen_model->Insert('transaksi',$insert_data)=="OK"){
      
    $update_data=array();
    $update_data['total']             = $nominal_new;
    $gen_model->Update('dompet',$update_data,$where_id_dompet);

    echo "OK";

    // $gen_controller->redirect_alert('transaksi','Biodata Berhasil di tambah');
    }
    else {
     echo "Terjadi kesalahan";
    }
  }
  else {
     //$gen_controller->redirect_alert('window_back','Terjadi kesalahan2');
  }
  //add end
}
//========================delete==========================================
else if($act=="delete"){
  //Paramater
  $where_data = array();
  $where_data['id_transaksi']      = $gen_controller->decrypt($_GET['id_parameter']);

  //Hapus Foto

  
  //Hapus data     'nama tabel di DB'
  if($gen_model->Delete('transaksi',$where_data)=="OK"){
    //$gen_controller->redirect_alert('transaksi','Data booking Berhasil di hapus');
  }
  else {
    //$gen_controller->redirect_alert('transaksi','Terjadi kesalahan');
  }
}
//hapus end
//========================edit==========================================
else if($act=="edit" and $id_parameter!=""){
$edit = $gen_model->GetOneRow('transaksi',array('id_transaksi'=>$gen_controller->decrypt($id_parameter))); 
    foreach($edit as $key=>$val){
                  $key=strtolower($key);
                  $$key=$val;
                  }

$edit2 = $gen_model->GetOneRow('kategori',array('id_kategori'=>$id_kategori)); 
    $data = array('id_dompet'=>$id_dompet,
                  'tanggal_transaksi'=>$tanggal_transaksi,
                  'id_transaksi'=>$id_parameter,
                  'id_kategori'=>$id_kategori,
                  'id_jenis'=>$edit2['id_jenis'],
                  'jumlah_transaksi'=>$jumlah_transaksi,
                  'keterangan_transaksi'=>$keterangan_transaksi,
                  ''
                );

    echo json_encode($data); 
}

else if($act=="do_edit"){

  //fasilitas
  $fasilitas = $gen_controller->array_to_string($_POST['fasilitas'],',');

  //Proses
  $update_data = array();
  $update_data['nama_pemesan']      = $_POST['nama_pemesan'];
  $update_data['telp']              = $_POST['telp'];
  $update_data['id_pembayaran']     = $_POST['pembayaran'];
  $update_data['id_jumlah']         = $_POST['jumlah'];
  $update_data['fasilitas']         = $fasilitas;
  $update_data['tanggal_booking']   = date("Y-m-d H:i:s");
  
  
  //Paramater
  $where_data = array();
  $where_data['id_hotel']      = $gen_controller->decrypt($_POST['id_hotel']);
  
  if($update_data['nama_pemesan']!=""){

    
    if($gen_model->Update('hotel',$update_data,$where_data)=="OK"){
      
      $gen_controller->redirect_alert('hotel','Biodata Berhasil di ubah');
    }
    else {
      $gen_controller->redirect_alert('window_back','Terjadi1 kesalahan');
    }

  }
  else {
     $gen_controller->redirect_alert('window_back','Terjadi2 kesalahan');
  }
  
}
//======================================TRANSKAKSASI=================================================================================
else if($act=="list_rest_tr"){

  $id_user      = $_SESSION['id_user'];
  $where_costum = $_REQUEST['id_dpt'];
  $aColumns     = array('kt.nama_kategori',
                        'jns.jenis',
                        'tr.jumlah_transaksi',
                        'dp.nama_dompet',
                        'tr.keterangan_transaksi',
                        'tr.tanggal_transaksi '); //Kolom Pada Tabel
  
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

  $rResult        = $tr->getDataTransaksi($sWhere,$sOrder,$sLimit,$where_costum,$id_user);
  $rResultFilterTotal   = $tr->getCountListTransaksi($sWhere,$where_costum,$id_user);

  $output = array(
    "sEcho"                => (empty($input['sEcho']) ? '0' : intval($input['sEcho'])),
    "iTotalRecords"        => $rResultFilterTotal,
    "iTotalDisplayRecords" => $rResultFilterTotal,
    "aaData"               => array(),
  );

  while($aRow = $rResult->FetchRow()){
    
    $param_id = $gen_controller->encrypt($aRow['id_transaksi']);
    $edit = '<button  data-toggle="modal" data-target="#Modaledit" type="button" onclick="do_edit(\''.$param_id.'\')" class="btn btn-primary btn-xs"><i class="fa fa-pencil m-r-5"></i> Update</button>';
    $delete = '&nbsp; <button type="button" onclick="do_delete(\''.$param_id.'\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o m-r-5"></i> Delete</button>';

    $action = $edit.$delete;
    $row = array();
    $row = array($aRow['nama_kategori'],
                 $aRow['jenis'],
                 "Rp. ".int_to_rp($aRow['jumlah_transaksi']),
                 $aRow['nama_dompet'],
                 $aRow['keterangan_transaksi'],
                 $gen_controller->get_date_indonesia($aRow['tanggal_transaksi'])." ".substr($aRow['tanggal_transaksi'],10,9),
                 "<left>".$action."</left>");
    $output['aaData'][] = $row;
  }
  echo json_encode($output);
}

else {
	$gen_controller->response_code(http_response_code());
}
?>
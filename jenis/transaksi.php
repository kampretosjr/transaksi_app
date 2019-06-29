<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();

//check session
// session_start();
// if(empty($_SESSION['username'])){
//   $gen_controller->redirect('hotel/hotel');
// }

$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];
}

$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];
}

if($act=="" or $act==null) {
  //Model
  
  include "model/transaksi.php";
  include "model/dompet.php";
  include "model/kategori.php";

  $tr = new transaksi();
  $dp = new dompet();
  $kt = new kategori();


  //View
  include "view/header.php";
  include "view/transaksi.php";
  include "view/footer.php";
}
else if($act=="add"){
  //Model
  include "model/kategori.php";
  include "model/transaksi.php";
  include "model/dompet.php";

  $tr  = new transaksi();
  $dp = new dompet();
  $kt = new kategori();

  include "view/header.php";  
  include "view/transaksi_add.php";
  include "view/footer.php";
}
else if($act=="do_add"){ //add start

$where_id_dompet                  = array();
$where_id_dompet['id_dompet']      = $_POST['dompet'];

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

     $gen_controller->redirect_alert('transaksi','Biodata Berhasil di tambah');
    }
    else {
      $gen_controller->redirect_alert('window_back','Terjadi kesalahan 1');
    }
  }
  else {
     //$gen_controller->redirect_alert('window_back','Terjadi kesalahan2');
  }
  //add end
}
//dibawah ini progres untuk delete
else if($act=="delete"){
  //Paramater
  $where_data = array();
  $where_data['id_hotel']      = $gen_controller->decrypt($_GET['id_parameter']);

  //Hapus Foto

  
  //Hapus data     'nama tabel di DB'
  if($gen_model->Delete('hotel',$where_data)=="OK"){
    $gen_controller->redirect_alert('hotel','Data booking Berhasil di hapus');
  }
  else {
    $gen_controller->redirect_alert('hotel','Terjadi kesalahan');
  }
}
//hapus end
//edit start
else if($act=="edit" and $id_parameter!=""){
   //Model
  include "model/fasilitas.php";
  include "model/jumlah.php";
  include "model/pembayaran.php";
  include "model/hotel.php";
  
  $pb = new pembayaran();
  $fs  = new fasilitas();
  $jm  = new jumlah();

  //view
  include "view/header.php";	
  include "view/hotel_edit.php";
  include "view/footer.php";
}

else if($act=="do_edit"){



  //fasilitas
  $fasilitas = $gen_controller->array_to_string($_POST['fasilitas'],',');

  //Proses
  $update_data = array();
  $update_data['nama_pemesan']      = $_POST['nama_pemesan'];
  $update_data['telp']      = $_POST['telp'];
  $update_data['id_pembayaran']         = $_POST['pembayaran'];
  $update_data['id_jumlah']         = $_POST['jumlah'];
  $update_data['fasilitas']           = $fasilitas;
  $update_data['tanggal_booking'] = date("Y-m-d H:i:s");
  
  
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
else {
	$gen_controller->response_code(http_response_code());
}
?>
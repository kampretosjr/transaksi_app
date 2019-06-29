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
  
  include "model/kategori.php";
  include "model/jenis.php";
  include "model/dompet.php";

  $kt = new kategori();
  $jn = new jenis();
  $dp = new dompet();

  //View
  include "view/header.php";
  include "view/kategori.php";
  include "view/footer.php";
}
else if($act=="add"){
  //Model

 include "model/kategori.php";
  include "model/jenis.php";
  include "model/dompet.php";

  $kt = new kategori();
  $jn = new jenis();
  $dp = new dompet();
   
  include "view/header.php";  
  include "view/kategori_add.php";
  include "view/footer.php";
}
else if($act=="do_add"){ //add start


  //Proses
  $insert_data = array();
  $insert_data['nama_kategori']      = $_POST['nama_kategori'];
  $insert_data['id_jenis']      = $_POST['jenis'];
  
  if($insert_data['nama_kategori']!=""){
    if($gen_model->Insert('kategori',$insert_data)=="OK"){
     $gen_controller->redirect_alert('kategori','kategori Berhasil di tambah');
    }
    else {
      $gen_controller->redirect_alert('window_back','Terjadi kesalahan 1');
    }
  }
  else {
     $gen_controller->redirect_alert('window_back','Terjadi kesalahan2');
  }
  //add end
}
//dibawah ini progres untuk delete
else if($act=="delete"){
  //Paramater
  $where_data = array();
  $where_data['id_kategori']      = $gen_controller->decrypt($_GET['id_parameter']);

  //Hapus Foto

  
  //Hapus data     'nama tabel di DB'
  if($gen_model->Delete('kategori',$where_data)=="OK"){
    $gen_controller->redirect_alert('kategori','Data booking Berhasil di hapus');
  }
  else {
    $gen_controller->redirect_alert('kategori','Terjadi kesalahan');
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
<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();

$act="";
if(isset($_GET['do_act'])){
    $act = $_GET['do_act'];}

$id_parameter="";
if(isset($_GET['id_parameter'])){
        $id_parameter =$_GET['id_parameter'];}

if($act=="" or $act==null) {
  $check_data = array();
  $check_data['username']      = $_POST['username'];
  $check_data['password']      = $_POST['pwd'];

  $usr = $gen_model->GetOneRow('user' ,$check_data);
  if(!empty($usr['username'])){
    
    session_start();
    $_SESSION['username']           = $usr['username'];
    $_SESSION['telpon']             = $usr['telpon'];
    $_SESSION['email']             = $usr['email'];
    $_SESSION['id_user']            = $usr['id_user'];
    
    $gen_controller->redirect('home');
  }
  else {
    session_start();
    $gen_controller->redirect_alert('','username atau pass salah');
    session_destroy();
  }
}
elseif ($act=="register") {
  $insert_data = array();
  $insert_data['username']      = $_POST['username'];
  $insert_data['password']      = $_POST['pwd'];
  $insert_data['telpon']      = $_POST['telpon'];
  if($insert_data['username']!=""){
    if($gen_model->Insert('user',$insert_data)=="OK"){
     $gen_controller->redirect_alert('index','user baru Berhasil di tambah');
    }
    else {
      $gen_controller->redirect_alert('window_back','Terjadi kesalahan1');
    }
  }
  else {
      //$gen_controller->redirect_alert('window_back','Terjadi kesalaha2n');
  }
}
elseif ($act=="logout") {
  session_start();
  session_destroy();
  $gen_controller->redirect('');
}

else {
	$gen_controller->response_code(http_response_code());
}
?>
<?php 
//General Controller
include "General_Controller.php";
$gen_controller  = new General_Controller();

//Model Global
include "model/General_Model.php";
$gen_model      = new General_Model();

//untuk meredirect ke halaman utama jika akun masih tersangkut ( belum di logout )
//check session
session_start();
if(!empty($_SESSION['username'])){
  $gen_controller->redirect('home');
}

//View
include "view/header.php";
include "view/login.php";
include "view/footer.php";
?>
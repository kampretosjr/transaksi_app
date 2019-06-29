<!-- <?php 
    $data_dompet  = $dp->getDataDompet($_SESSION['id_user']);
     
?> -->

<style type="text/css">
  .dt-right{
    text-align:right;
  }
</style>

 <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">transaksi</h4>
                        
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                       

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <div class="row">
                                <div class="col-md-6">
                                <form method="POST">
                                        <?php  
                                          $id_dompet= $db->GetOne("select id_dompet from dompet WHERE id_user='".$_SESSION['id_user']."' order by total desc"); 
                                        ?>

                                        <select name="pilih_dompet" onchange="getdompet()" id="dompet"  class="form-control" required>
                                          <option value="">Pilih dompet</option>
                                          <?php
                                            $data_dompet  = $dp->getDataDompet($_SESSION['id_user']);
                                           while($list = $data_dompet->FetchRow()){
                                          foreach($list as $key=>$val){
                                              $key="mb_".strtolower($key);  //mb << alias jadi uk_nama_kolom supaya tidak redudansi data 
                                              $$key=$val;
                                            }  
                                          ?>
                                          <option <?php echo ($id_dompet==$mb_id_dompet ? 'selected' : '') ?> value="<?php echo $mb_id_dompet ?>"><?php echo $mb_nama_dompet?>- Rp <?php echo int_to_rp($mb_total)?></option>
                                          <?php } ?>
                                        </select></br>
                                        <?php 
                                           if (!empty($id_dompet)) {  ?>
                                              <script type="text/javascript">
                                                setTimeout(function(){ 
                                                   getdompet();
                                                },10);
                                            </script>
                                        <?php }  ?>
                                </form>
                                </div></br>
                                    <div class="col-md-6">
                                    <button style="float:right" data-toggle="modal"  data-target="#myModal" class='btn btn-lg btn-success' >tambah</button>
                                </div>
                              </div>


                                <div class="table-responsive">
                                    <table id="transaksi" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>kategori</th>
                                                <th>jenis transaksi</th>
                                                <th>jumlah transaksi</th>
                                                 <th>dompet</th>
                                                 <th>catatan transaksi</th>
                                                <th>tanggal transaksi</th>
                                                 <th>action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                                                                          
                                        </tbody>
                                        
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
  <!-- =================================Modal add=================================-->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                  <div class="modal-header">
                      <h4 class="modal-title">Transaksi</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              
                              <div class="x_content">
                                <br/>
                                <form id="form_add" data-parsley-validate class="form-horizontal form-label-left">
                                

                                  <div class="form-group">
                                    <div class="row">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal transaksi<span class="required"></span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" id="datePicker" name="tanggal_transaksi" value="<?php echo date("Y-m-d") ?>" required="required" class="form-control col-md-7 col-xs-12">
                                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'];?>">
                                      </div>
                                    </div><br>

                                    <div class="row">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jumlah transaksi<span class="required"></span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" autocomplete="off" name="nominal_transaksi" required="required" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div><br>

                                    <div class="row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">catatan transaksi<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" name="keterangan"  class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div><br>

                                    <div class="row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">jenis transaksi<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <select onchange="getjenis('add')" name="jenis_transaksi" id="jenis_transaksi" class="form-control">
                                       <option value="">Pilih kategori</option>
                                       <?php              // nama tabel
                                        $data_jenis = $gen_model->GetWhere('jenis');
                                          while($list = $data_jenis->FetchRow()){
                                            foreach($list as $key=>$val){
                                                        $key=strtolower($key);
                                                        $$key=$val;
                                                      }  ?>               <!--  nama kolom -->
                                          <option value="<?php echo $id_jenis ?>"><?php echo $jenis ?></option>
                                      <?php } ?>
                                    </select>
                                    </div>
                                  </div><br>

                                    <div class="row">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategogori<span class="required"></span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  name="kategori" id="kategori"  class="form-control">
                                         <option value="">Pilih kategroiri</option>

                                       </select>
                                      </div>
                                  </div><br>
                                  <div class="row">
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">tambahkan transaksi ke <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select name="dompet" class="form-control" id="dompet_add" required>
                                        <option value="">Pilih dompet</option>
                                        <?php
                                         $data_dompet  = $dp->getDataDompet($_SESSION['id_user']);
                                         while($list = $data_dompet->FetchRow()){
                                        foreach($list as $key=>$val){
                                            $key="jm_".strtolower($key);  //jm << alias jadi jm_nama_kolom supaya tidak redudansi data 
                                            $$key=$val;
                                          }  
                                        ?>
                                        <option  value="<?php echo $jm_id_dompet ?>"><?php echo $jm_nama_dompet ?>-<?php echo $jm_total ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    </div>
                                    </div></div>

                                  <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      <button class="btn btn-primary" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                      <button class="btn btn-primary" type="reset">Reset</button>
                                      <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                  </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>     
                       </div>
                      </div>
                    </div>
                  </div>
                  <!-- ===================================================== -->
  <!-- =================================Modal edit=================================-->
            <div id="Modaledit" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                  <div class="modal-header">
                      <h4 class="modal-title">Transaksi</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              
                              <div class="x_content">
                                <br/>
                                <form id="form_edit" data-parsley-validate class="form-horizontal form-label-left">
                                

                                  <div class="form-group">
                                    <div class="row">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal transaksi<span class="required"></span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="tanggal" name="tanggal_transaksi" required="required" class="form-control col-md-7 col-xs-12">
                                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'];?>">
                                      </div>
                                    </div><br>

                                    <div class="row">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jumlah transaksi<span class="required"></span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="nominal_edit" autocomplete="off" name="nominal_transaksi" required="required" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div><br>

                                    <div class="row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">catatan transaksi<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="keterangan" name="keterangan"  class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div><br>

                                    <div class="row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">jenis transaksi<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <select onchange="getjenis('edit')" name="jenis_transaksi" id="jenis_transaksi_edit" class="form-control">
                                       <option value="">Pilih kategori</option>
                                       <?php              // nama tabel
                                        $data_jenis = $gen_model->GetWhere('jenis');
                                          while($list = $data_jenis->FetchRow()){
                                            foreach($list as $key=>$val){
                                                        $key=strtolower($key);
                                                        $$key=$val;
                                                      }  ?>               <!--  nama kolom -->
                                          <option value="<?php echo $id_jenis ?>"><?php echo $jenis ?></option>
                                      <?php } ?>
                                    </select>
                                    </div>
                                  </div><br>

                                    <div class="row">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori<span class="required"></span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  name="kategori" id="kategori_edit" class="form-control">
                                       <option value="">Pilih kategori</option>
                                       <?php              // nama tabel
                                        $dt_kategori = $gen_model->GetWhere('kategori');
                                          while($list = $dt_kategori->FetchRow()){
                                            foreach($list as $key=>$val){
                                                        $key=strtolower($key);
                                                        $$key=$val;
                                                      }  ?>               <!--  nama kolom -->
                                          <option value="<?php echo $id_kategori ?>"><?php echo $nama_kategori ?></option>
                                      <?php } ?>
                                    </select>
                                      </div>
                                  </div><br>
                                  <div class="row">
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">tambahkan transaksi ke <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select name="dompet" class="form-control" id="dompet_edit" required>
                                        <option value="">Pilih dompet</option>
                                        <?php
                                         $data_dompet  = $dp->getDataDompet($_SESSION['id_user']);
                                         while($list = $data_dompet->FetchRow()){
                                        foreach($list as $key=>$val){
                                            $key="jm_".strtolower($key);  //jm << alias jadi jm_nama_kolom supaya tidak redudansi data 
                                            $$key=$val;
                                          }  
                                        ?>
                                        <option  value="<?php echo $jm_id_dompet ?>"><?php echo $jm_nama_dompet ?>-<?php echo $jm_total ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    </div>
                                    </div></div>

                                  <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      <button class="btn btn-primary" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                      <button class="btn btn-primary" type="reset">Reset</button>
                                      <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                  </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>     
                       </div>
                      </div>
                    </div>
                  </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                <button onclick="myFunction()">nyobain</button>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- <script type="text/javascript" src="transaksi/assets/sweetalert2/dist/sweetalert2.min.js"></script> -->
    

      

    <script type="text/javascript">
  
  

function myFunction() {
  swal({
    title: 'mau reload?',
    type: 'question',
    confirmButtonText:
    'ya <i class="fa fa-arrow-right></i>',
    showCancelButton: false,
    showLoaderOnConfirm: false,
  }).then( function() 
         {location.reload();}
    
  );
}


////////////////////////////////////////////////select dompet
    function getdompet(){
      var dmpt = $("#dompet").val();
      if(dmpt!=""){
           $("#dompet_add").val(dmpt);
           var dTable;

           if ($.fn.dataTable.isDataTable('#transaksi')){
             dTable = $('#transaksi').DataTable();
             dTable.destroy();
           }

           dTable = $('#transaksi').DataTable( {
                  "bProcessing": true,
                  "bServerSide": true,
                  "bJQueryUI": false,
                  "responsive": false,
                  "autoWidth": false,
                  "sAjaxSource": "<?php echo $basepath ?>transaksi/list_rest_tr&id_dpt="+dmpt, 
                  "sServerMethod": "POST",
                  "scrollX": true,
                  "scrollY": "350px",
                    "scrollCollapse": true,
                  "columnDefs": [
                  { "orderable": true, "targets": 0, "searchable": true},
                  { "orderable": true, "targets": 1, "searchable": true},
                  { "orderable": true, "targets": 2, "searchable": true, "className": "dt-right"},
                  { "orderable": true, "targets": 3, "searchable": true},
                  { "orderable": true, "targets": 4, "searchable": true},
                  { "orderable": true, "targets": 5, "searchable": true},
                  { "orderable": false, "targets": 6, "searchable": false, "width":170}
                  ]
                });
      }
      else {$("#transaksi").html("");}
    }
 ////////////////////////////////////////////////TAMBAH
 $("#form_add").on("submit", function (event) {
          event.preventDefault();
            do_act('form_add','transaksi/do_add','','Add transaksi','Are you sure want to insert transaksi ?','info');
          });
////////////////////////////////////////////////EDIT
$("#form_edit").on("submit", function (event) {
          event.preventDefault();
            do_act('form_edit','transaksi/do_update','','Update transaksi','Are you sure want to update transaksi ?','warning');
        });
function do_edit(id){
          $.ajax({
                url: '<?php echo $basepath ?>transaksi/edit/'+id,
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    $("#id_parameter").val(data.id_transaksi);
                    $("#tanggal").val(data.tanggal_transaksi);
                    $("#keterangan").val(data.keterangan_transaksi);
                    $("#jenis_transaksi_edit").val(data.id_jenis);
                    $("#kategori_edit").val(data.id_kategori);
                    $("#nominal_edit").val(data.jumlah_transaksi);
                    $("#dompet_edit").val(data.id_dompet);
                }
            });
        }
///////////////////////////////////////DELETE        
function do_delete(id){
          swal({
            title: 'yakin mau di hapus ?',
            text: ' transaksi ini akan hilang',
            type: 'question',      // warning,info,success,error
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: function(){
              $.ajax({
                  url: '<?php echo $basepath ?>transaksi/do_delete',
                  type: 'POST',
                  data: 'id_parameter='+id,
                  success: function(data) {
                    if(data=="OK"){
                      swal({
                        title: 'Success',
                        type: 'success',
                        showCancelButton: false,
                        showLoaderOnConfirm: false,
                      }).then(function() {
                        location.reload();      
                      });
                    }
                    else if(data=="NOT_LOGIN"){
                      swal({
                        title: 'Error',
                        text: "You Must Login Again",
                        type: 'error',
                        showCancelButton: false,
                        showLoaderOnConfirm: false,
                      },function(){
                            location.reload();
                      });
                    }
                    else{
                      swal({
                        title: 'Success',
                        type: 'success',
                        showCancelButton: false,
                        showLoaderOnConfirm: false,
                      }).then(function() {
                        location.reload();      
                      });
                    }
                  }
              });
             }
          });
        }
    </script>
    
  
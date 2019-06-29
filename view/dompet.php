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
                        <h4 class="page-title">Tables</h4>
                        <div class="ml-auto text-right">
                            <div class="col-md-12">
                                    <button style="float:right" data-toggle="modal" data-target="#myModal" class='btn btn-lg btn-success' >tambah</button>
                                </div>
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
                                <h5 class="card-title">Dompet</h5>
                                <div class="table-responsive">
                                    <table id="jamban" class="table table-striped table-bordered">
                                        <thead>
                                            <tr  style="text-align:center">
                                                <th>nama dompet</th>
                                                <th>nominal</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                                                          
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>nama dompet</th>
                                                <th>nominal</th>
                                                <th>action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content ">
                      <div class="modal-header">
                        <h4 class="modal-title">tambah kategori</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                  
                                  <div class="x_content">
                                    <br/>
                                    <form id="form_add" data-parsley-validate class="form-horizontal form-label-left">

                                      <div class="form-group">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama dompet</label> 
                                         <div class="col-md-12 ">
                                            <input type="text" name="nama_dompet" required="required" class="form-control col-md-6">
                                         </div>

                                            
                                            
                                      </div>
                                      <div class="ln_solid"></div>
                                          <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                              <button class="btn btn-primary" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                              <button class="btn btn-primary" type="reset">Reset</button>
                                              <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                          </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>     
                           </div>
                        <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>

                <div id="Modaledit" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content ">
                      <div class="modal-header">
                        <h4 class="modal-title">edit dompet</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                  
                                  <div class="x_content">
                                    <br/>
                                    <form id="form_edit" data-parsley-validate class="form-horizontal form-label-left">

                                      <div class="form-group">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama dompet</label> 
                                         <div class="col-md-12 ">
                                            <input type="text" name="nama_dompet" id="dompet_edit" required="required" class="form-control col-md-6">
                                             <input name="id_parameter" id="id_parameter" type="hidden" required>
                                         </div>
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">nominal</label> 
                                         <div class="col-md-12 ">
                                            <input type="text" name="nominal" id="nominal_edit" required="required" class="form-control col-md-6">
                                            
                                         </div>

                                           
                                            
                                      </div>
                                      <div class="ln_solid"></div>
                                          <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                              <button class="btn btn-primary" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                              <button class="btn btn-primary" type="reset">Reset</button>
                                              <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                          </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>     
                           </div>
                        <div class="modal-footer">
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
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
   
    
    <script type="text/javascript">
//////////////////////////////////////////////////DATABTATABLE       
      $(document).ready(function() {
          dTable = $('#jamban').DataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "bJQueryUI": false,
            "responsive": false,
            "autoWidth": false,
            "sAjaxSource": "<?php echo $basepath ?>dompet/list_rest_dp", 
            "sServerMethod": "POST",
            "scrollX": true,
            "scrollY": "350px",
              "scrollCollapse": true,
            "columnDefs": [
                { "orderable": true, "targets": 0, "searchable": true},
                { "orderable": true, "targets": 1, "searchable": true},
                { "orderable": false, "targets": 2, "searchable": false, "width":170}
            ]
          });
        });

////////////////////////////////////////////////TAMBAH
 $("#form_add").on("submit", function (event) {
          event.preventDefault();
            do_act('form_add','dompet/do_add','','Add dompet','Are you sure want to insert dompet ?','info');
          });
////////////////////////////////////////////////EDIT
$("#form_edit").on("submit", function (event) {
          event.preventDefault();
            do_act('form_edit','dompet/do_update','','Update dompet','Are you sure want to update dompet ?','warning');
        });
function do_edit(id){
          $.ajax({
                url: '<?php echo $basepath ?>dompet/edit/'+id,
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    $("#id_parameter").val(data.id_dompet);
                    $("#dompet_edit").val(data.nama_dompet);
                    $("#nominal_edit").val(data.total);
                }
            });
        }
///////////////////////////////////////DELETE        
function do_delete(id){
          swal({
            title: 'yakin mau di hapus ?',
            text: ' semua transaksi yang berhubungan degan dompet ini akan hilang',
            type: 'question',      // warning,info,success,error
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: function(){
              $.ajax({
                  url: '<?php echo $basepath ?>dompet/do_delete',
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

 
   
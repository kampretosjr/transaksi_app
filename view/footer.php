
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo $basepath ?>assets/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo $basepath ?>assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo $basepath ?>assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo $basepath ?>assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo $basepath ?>assets/dist/js/custom.min.js"></script>
    <!-- misc js -->
    <script src="<?php echo $basepath ?>assets/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/chart/matrix.interface.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/chart/excanvas.min.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/flot/jquery.flot.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/flot/jquery.flot.time.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/chart/jquery.peity.min.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/chart/matrix.charts.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/chart/jquery.flot.pie.min.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo $basepath ?>assets/assets/libs/chart/turning-series.js"></script>
    <script src="<?php echo $basepath ?>assets/dist/js/pages/chart/chart-page-init.js"></script>
<script src="<?php echo $basepath ?>assets/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="<?php echo $basepath ?>assets/sweetalert2/dist/sweetalert2.min.css">
     <script type="text/javascript"> 


////////////////////////temenya select dompet    
      function getjenis(act){
      var jns = "";
          if(act=="add"){
             jns = $("#jenis_transaksi").val();
          }
          else {
             jns = $("#jenis_transaksi_edit").val();
          }
      if(jns!=""){
        $.ajax({
              url: '<?php echo $basepath ?>ajax/getjenis',
              type: 'POST',
              dataType: 'html',
              data: 'id_ktg='+jns,
              success: function(getdata) {
                if(act=="add"){
                    $("#kategori").html(getdata);
                }
                else {
                   $("#kategori_edit").html(getdata);
                }
                
              }
          });
      }
      else {$("#kategori").html("");}
    }
    
 $(".select2").select2();
  function do_act(form_id,act_controller,after_controller,header_text,content_text,type_icon,fct_after){
                        swal({
                          title: header_text,
                          text: content_text,
                          type: type_icon,      // warning,info,success,error
                          showCancelButton: true,
                          showLoaderOnConfirm: true,
                          preConfirm: function(){
                            $.ajax({
                                url: act_controller, 
                                type: 'POST',
                                data: new FormData($('#'+form_id)[0]),  // Form ID
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    var data_trim = $.trim(data);
                                    if(data_trim=="OK")
                                    {
                                        swal({
                                            title: 'Success',
                                            type: 'success',
                                            showCancelButton: false,
                                            showLoaderOnConfirm: false,
                                          }).then(function() {
                                              if(after_controller=='no_refresh'){
                                                   window[fct_after]();   
                                              }
                                              else if(after_controller!=''){
                                                 window.location = '<?php echo $basepath ?>'+after_controller;
                                              }
                                              else {
                                                location.reload();
                                              } 
                                      });
                                    } 
                                    else if(data_trim=="NOT_LOGIN")
                                    {
                                          swal({
                                            title: 'Error',
                                            text: "You Must Login Again",
                                            type: 'error',
                                            showCancelButton: false,
                                            showLoaderOnConfirm: false,
                                          },function(){
                                                window.location = '<?php echo $basepath ?>';
                                          });
                                    }
                                    else
                                    {
                                        swal({
                                            title: 'Error',
                                            html: data_trim,
                                            type: 'error',
                                            showCancelButton: false,
                                            showLoaderOnConfirm: false,
                                          });
                                    }
                                }
                            });
                         }
            });   
}    
  </script>

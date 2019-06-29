  <?php 
    $data_dompet  = $dp->getDataDompet();
    $data_kategori  = $kt->getDataKategori();
    
  ?>
  <title>Tambah TRansaksi</title>
  </head>
  <body>
    <div style="padding-right: 0px;" class="container">
      <div class="row">
        <div class="col-md-12">
          <h5 class="mt-5">Tambah TRansaksi</h5><br/>
          <form method="POST" action="<?php echo $basepath ?>transaksi/do_add" enctype="multipart/form-data">
            
           
                <div class="row">
                    <div class="col-md-4">
                      nominal transaksi<br/>
                      <input type="number"  name="nominal_transaksi" class="form-control" maxlength="20" required>
                    </div>
                  </div>
                    <br/>

                   
                     <div class="row">
                      <div class="col-md-4">
                        <label>jenis transaksi</label>
                        <select onchange="getjenis()" name="jenis_transaksi" id="jenis_transaksi" class="form-control">
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
                    </div>
                    
                        
                    <br/>
                    <div class="row">
                      <div class="col-md-4">
                        <label>kategroi</label>
                        <select  name="kategori" id="kategori" class="form-control">
                           <option value="">Pilih kategroiri</option>
                           <?php                  // nama tabel
                            $data_kategori = $gen_model->GetWhere('kategori');
                              while($list = $data_kategori->FetchRow()){
                                foreach($list as $key=>$val){
                                            $key=strtolower($key);
                                            $$key=$val;
                                          }  ?>
                              <option value="<?php echo $id_kategori ?>"><?php echo $nama_kategori ?></option>
                          <?php } ?>
                        </select>
                      </div></div><br/>
                    
                      <div class="row">
                     <div class="col-md-4">
                      keterangan<br/>
                      <input type="text"  name="keterangan" class="form-control" maxlength="20" required>
                    </div>
                  </div></div>
                  <br>
                 
                  <div class="row">
                    <div class="col-md-4">
                      tanggal transaksi<br>
                     <input type="date" name="tanggal_transaksi"> </div></div> <br> 
                    
                    <div class="row">
                    <div class="col-md-4">
                      dompet
                      <select name="dompet" class="form-control" required>
                        <option value="">Pilih dompet</option>
                        <?php
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
                  </div></div>

                <div class="row">
                    <div class="col-md-12"><br/>
                        <center>
                          <a href="<?php echo $basepath ?>"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-left"></i>Kembali</button></a>&nbsp;
                          <button type="reset"  class="btn btn-warning"><i class="fa fa-eraser"></i>  Reset</button>&nbsp;
                          <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>  Tambah</button>
                       </center>
                    </div>
                </div>
           
                    
                    
        </form>
        </div>
      </div>
    </div>
      <script type="text/javascript">
      function getjenis(){
      var jns = $("#jenis_transaksi").val();
      if(jns!=""){
        $.ajax({
              url: '<?php echo $basepath ?>ajax/getjenis',
              type: 'POST',
              dataType: 'html',
              data: 'id_ktg='+jns,
              success: function(getdata) {
                  $("#kategori").html(getdata);

              }
          });
      }
      else {
        $("#kategori").html("");

      }
    }
    

  </script>
  </body>
</html>
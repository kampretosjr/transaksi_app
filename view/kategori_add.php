  <?php 
    $data_dompet  = $dp->getDataDompet();
    $data_jenis  = $jn->getDataJenis();
  ?>
  <title>Tambah kategori</title>
  </head>
  <body>
    <div style="padding-right: 0px;" class="container">
      <div class="row">
        <div class="col-md-12">
          <h5 class="mt-5">Tambah kategori</h5><br/>
          <form method="POST" action="<?php echo $basepath ?>kategori/do_add" enctype="multipart/form-data">
            
           
                <div class="row">
                    <div class="col-md-4">
                      nama kategori<br/>
                      <input type="text"  name="nama_kategori" class="form-control" maxlength="20" required>
                    </div>
                   
                    <!-- tes <div class="col-md-4">
                      dompet
                      <select name="dompet" class="form-control" required>
                        <option value="">Pilih dompet</option>
                        <?php
                         while($list = $data_dompet->FetchRow()){
                        foreach($list as $key=>$val){
                            $key="jm_".strtolower($key);  //ag << alias jadi jm_nama_kolom supaya tidak redudansi data 
                            $$key=$val;
                          }  
                        ?>
                        <option  value="<?php echo $jm_id_dompet ?>"><?php echo $jm_nama_dompet ?></option>
                        <?php } ?>
                      </select>
                    </div> -->
                    
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      jenis<br/>
                        <input type="radio" name="jenis" value="1"> PEMASUKAN<br>
                        <input type="radio" name="jenis" value="2"> PENGELUARAN<br>
                    </div> 
                    
                </div>
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
  </body>
</html>
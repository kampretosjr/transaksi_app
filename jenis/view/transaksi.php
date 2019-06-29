<?php 
    $data_dompet  = $dp->getDataDompet();
    // $data_kategori  = $dp->getDataKategori();

 // echo "<h5 class='mt-5'>User :</h5>" , $_SESSION['username'];
?>
  	<title>Manage transaksi</title>
  </head>
  <body>
  	<div style="padding-right: 0px;" class="container">
  		<div class="row">
  			<div class="col-md-12">
  				<h5 class="mt-5">Manage transaksi</h5>
          <!-- jangan lupa menyesuaikan/menggantilink pada $basepath dengan yang ada di general controler -->
  				<a href="<?php echo $basepath ?>transaksi/add"><button class="btn btn-success"><i class="fa fa-plus"></i> Tambah transaksi</button></a><br/><br/>
          <form method="POST">
          <div class="col-md-6">
                  dompet<br/>
                  <select name="pilih_dompet" onchange="getdompet()" id="dompet"  class="form-control" required>
                    <option value="">Pilih dompet</option>
                    <?php
                     while($list = $data_dompet->FetchRow()){
                    foreach($list as $key=>$val){
                        $key="mb_".strtolower($key);  //mb << alias jadi uk_nama_kolom supaya tidak redudansi data 
                        $$key=$val;
                      }  
                    ?>
                    <option value="<?php echo $mb_id_dompet ?>"><?php echo $mb_nama_dompet?></option>
                    <?php } ?>
                  </select>
                  </br>
                </div></br>
                </form>
  				<table  style='width:80%' id="transaksi" class="table table-bordered table-striped">
  		
  				</table>
           <P ALIGN="right">
             
          </P>
  			</div>
  		</div>
      <a href="<?php echo $basepath ?>kategori/"><button class="btn btn-xs btn-info">kategori</button></a>
    <br>
    <a href="<?php echo $basepath ?>/"><button class="btn btn-xs btn-info">index</button></a>
  	</div>

    <script type="text/javascript">
    function getdompet(){
      var dmpt = $("#dompet").val();
      if(dmpt!=""){
        $.ajax({
              url: '<?php echo $basepath ?>ajax/getdompet',
              type: 'POST',
              dataType: 'html',
              data: 'id_dpt='+dmpt,
              success: function(getdata) {
                  $("#transaksi").html(getdata);

              }
          });
      }
      else {
        $("#transaksi").html("");

      }
    }
    

  </script>
  </body>
</html>
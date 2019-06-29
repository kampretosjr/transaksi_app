
  	<title>Manage kategori</title>
  </head>
  <body>
  	<div style="padding-right: 0px;" class="container">
  		<div class="row">
  			<div class="col-md-12">
  				<h5 class="mt-5">Manage kategori</h5>
          <!-- jangan lupa menyesuaikan/menggantilink pada $basepath dengan yang ada di general controler -->
  				<a href="<?php echo $basepath ?>kategori/add"><button class="btn btn-success"><i class="fa fa-plus"></i> Tambah kategori</button></a><br/><br/>
  				<table   class="table table-bordered table-striped">
  				   	 <tr>
  						<th>No.</th>
              			<th>nama kategori</th>
              			<th>jenis kategori</th>
  						<th align="center">Action</th>
  					 </tr>
              <?php
              $data_kategori  = $kt->getDataKategori();
              $i=1;
              
              while($list = $data_kategori->FetchRow()){
              foreach($list as $key=>$val){
                  $key=strtolower($key);
                  $$key=$val;
                } 
              ?>
      					<tr>              
      				<td><?php echo $i ?></td>
                    <td><?php echo $nama_kategori ?></td>
                    <td><?php echo $jenis ?></td>

                    <td align="center" style="width:80%">
                      <a href="<?php echo $basepath ?>kategori/edit/<?php echo $gen_controller->encrypt($id_kategori); ?>"><button class="btn btn-xs btn-warning">Edit</button></a>
                      <a href="<?php echo $basepath ?>kategori/delete/<?php echo $gen_controller->encrypt($id_kategori); ?>"><button class="btn btn-xs btn-danger">Hapus</button></a>
                    </td>
      					</tr>
            <?php 
             $i++; }
             ?>
  				</table>
           <P ALIGN="right">
             
          </P>
  			</div>
  		</div>
      <a href="<?php echo $basepath ?>"><button class="btn btn-xs btn-warning">index</button></a>
    <br>
    <a href="<?php echo $basepath ?>transaksi/"><button class="btn btn-xs btn-warning">transaksi</button></a>
  	</div>
  </body>
</html>
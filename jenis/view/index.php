<body>
	<div class="container">
		
		<div class="row">
			<div class="col-md-12">
				<label>jenis transaksi</label>
				<select onchange="getjenis()" name="jenis_transaksi" id="jenis_transaksi" class="form-control">
					 <option value="">Pilih kategori</option>
					 <?php 							// nama tabel
						$data_jenis = $gen_model->GetWhere('jenis');
							while($list = $data_jenis->FetchRow()){
								foreach($list as $key=>$val){
		                        $key=strtolower($key);
		                        $$key=$val;
		                      }  ?>								<!--  nama kolom -->
							<option value="<?php echo $id_jenis ?>"><?php echo $jenis ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
        
		<div class="row"><br/>
			<div class="col-md-12">
				<label>kategroiri</label>
				<select  name="kategori" id="kategori" class="form-control">
					 <option value="">Pilih kategroiri</option>
					 <?php 									// nama tabel
						$data_kategori = $gen_model->GetWhere('kategori');
							while($list = $data_kategori->FetchRow()){
								foreach($list as $key=>$val){
		                        $key=strtolower($key);
		                        $$key=$val;
		                      }  ?>
							<option value="<?php echo $id_kategori ?>"><?php echo $nama_kategori ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<br>
		<a href="<?php echo $basepath ?>kategori/"><button class="btn btn-xs btn-warning">kategori</button></a>
		<br>
		<a href="<?php echo $basepath ?>transaksi/"><button class="btn btn-xs btn-warning">transaksi</button></a>
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
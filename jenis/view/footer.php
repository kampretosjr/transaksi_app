 <!-- typeahed awto komplid -->
    <script src="<?php echo $basepath?>assets/typeahead/bootstrap3-typeahead.min.js"></script>
   <script type="text/javascript">
	$('#nama').typeahead({
	hint: true,
	highlight: true,
	source: function (query, process) {
	    $.ajax({
	        url: '<?php echo $basepath ?>ajax/reqNama',// req nama controler AJAX
	        type: 'POST',
	        dataType: 'JSON',
	        data: 'query='+$('#nama').val(),//kata querry dari ajax controller
	        success: function(data) {
	            var results = data.map(function(item) {
	                var someItem = {name:item.label, myvalue:item.value ,username:item.username,nama:item.nama,kelamin:item.kelamin,email:item.email};
	                return someItem;
	            });
	            return process(results);
	        }
	    });
	},
	//item yang akan di tampilakn setelah autocomplete di click
	afterSelect: function(item) {
    	this.$element[0].value = item.nama
	},
	//
	updater: function(item) {
	    $('#kelamin').val(item.kelamin);
	    $('#username').val(item.username);
	    $('#email').val(item.email);
	    return item;
	}
});
</script>
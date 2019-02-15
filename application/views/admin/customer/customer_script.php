
<script type="text/javascript">
	function select_all(){
		length = $('.order_check:checked').length;
		if(length == 0)
			$('.order_check').prop('checked',true);
		else
			$('.order_check').prop('checked',false);
	}

	function ajax_delete(){
		if(!confirm('Có Chắc Xóa Những Đơn Này??'))
			return false;
		var arr_delete = [];
		item_checked = $('.order_check:checked');
		row_checked = item_checked.parents('tr');
		item_checked.each(function(){
			arr_delete.push($(this).data('id'));
		});
		$.ajax({
			url: '/admin/ajax/delete_all_order',
			type: 'post',
			dataType: 'json',
			data: {arr_delete: arr_delete},
		})
		.done(function(res) {
			console.log(res);
			if(res[0] == 'success')
				row_checked.remove();
			else if(res[0] == 'error')
				alert(res[1]);
		})
	}
	
	function preview_file() {
	  var preview = $('.img_preview img')[0];
	  var file    = $('[name="avatar"]')[0].files[0];
	  var reader  = new FileReader();
	  reader.addEventListener("load", function () {
	    preview.src = this.result;
	  }, false);
	  // Kích hoạt event load
	  if (file) {
	    reader.readAsDataURL(file);
	  }
	}
	
	$('#custom_overlay').click(function(){
		$(this).hide();
		 $('#edit_view').hide();
	});

</script>

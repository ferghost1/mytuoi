<script type="text/javascript">
	
	function change_pw(){
		$('.change_pass').toggle();
	}
	function match_pass(){
		$('#repassword').prop('pattern',$('#password').val());
		$('[name="renew_password"]').prop('pattern',$('[name="new_password"]').val());
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
			url: '/admin/user/ajax_delete_all',
			type: 'post',
			dataType: 'json',
			data: {arr_delete: arr_delete},
		})
		.done(function(res) {
			if(res[0] == 'success'){
				row_checked.remove();
			}
			else if(res[0] == 'error')
				alert(res[1]);
		})
	}

	function ajax_change_status(){
		if(!confirm('Có Chắc Thay Đổi??'))
			return false;
		var arr_change = [];
		item_checked = $('.order_check:checked');
		row_checked = item_checked.parents('tr');
		status_box = row_checked.find('.status_box');
		item_checked.each(function(){
			arr_change.push($(this).data('id'));
		});
		$.ajax({
			url: '/admin/user/ajax_change_status',
			type: 'post',
			dataType: 'json',
			data: {arr_change: arr_change},
		})
		.done(function(res) {
			if(res[0] == 'success'){
				console.log(status_box);
				item_checked.prop('checked',false);
				status_box.toggleClass('text-danger');
				status_box.toggleClass('text-success');
				status_box.each(function(){
					if($(this).hasClass('text-success')){
						$(this).html('Hoạt Động');		
					}
					else{
						$(this).html('Bị Khóa');
					}
				});
			}
			else if(res[0] == 'error')
				alert(res[1]);
		});
	}

	$('#custom_overlay').click(function(){
		$(this).hide();
		 $('#edit_view').hide();
	});
</script>

<style type="text/css">
	.change_pass{display: none}
</style>
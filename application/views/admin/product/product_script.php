
<script type="text/javascript">

	function preview_file() {
	  var preview = $('.img_preview img')[0];
	  var file    = $('[name="main_img"]')[0].files[0];
	  var reader  = new FileReader();
	  reader.addEventListener("load", function () {
	    preview.src = this.result;
	  }, false);
	  // Kích hoạt event load
	  if (file) {
	    reader.readAsDataURL(file);
	  }
	}
	function send_edit(obj){
		// alert('ff');
		pro_name = $('#edit_view [name="cate_name"]').val();
		pro_des = $('#edit_view [name="cate_des"]').val();
		pro_id  = obj.data('id');
		$.ajax({
			url: '/admin/cate_product/ajax_edit',
			type: 'post',
			dataType: 'json',
			data: {
				cate_id: cate_id,
				cate_name: cate_name,
				cate_des: cate_des,
			},
		})
		.done(function(res) {
			$('#edit_view .alert').hide();
			// If no error
			if(!res[0]){
				$('#edit_view .alert-success').show().html(res[1]);
				$('#cate_name'+cate_id).html(cate_name);
				$('#cate_des'+cate_id).html(cate_des);
			}
			else
				$('#edit_view .alert-danger').show().html(res[1]);

		});
	}	


	$('#custom_overlay').click(function(){
		$(this).hide();
		 $('#edit_view').hide();
	});


	function edit_cate(id){
		cate_name = $('#cate_name'+id).html();
		cate_des = $('#cate_des'+id).html();
		$('#edit_view [name="cate_name"]').val(cate_name);
		$('#edit_view [name="cate_des"]').val(cate_des);	
		$('#edit_view .submit_edit').data('id',id);
		$('#edit_view').show();
		$('#custom_overlay').show();
	}	

	function delete_cate(id){
			
	}
</script>


<script type="text/javascript">



	
	function send_edit(obj){

		// alert('ff');
		cate_name = $('#edit_view [name="cate_name"]').val();
		cate_des = $('#edit_view [name="cate_des"]').val();
		cate_id  = obj.data('id');
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

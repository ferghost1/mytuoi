
<script type="text/javascript">
	window.onload = function(){
		$('.pro_id ').change();
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

	function update_cart(obj){
		parent = obj.parents('.product-row');
		product = parent.find('select.pro_id option:selected');
		one_price = parent.find('input.one_price');
		qty = parent.find('input.qty');
		// console.log(product.data('p'));
		sum = parent.find('input.sum');
		one_price.val(product.data('price'));
		sum.val(qty.val()*one_price.val());
		//Check if product_id exist
	}

	// function check_exist(obj){
	// 	$('.pro_id option')
	// }

	function add_product(){
		last_product = $('.product-row').last();
		last_product.after(last_product.clone());
	}

</script>

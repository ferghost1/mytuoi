
<script type="text/javascript">
<?php if(!empty($chart)):?>
	chart_info = $.parseJSON('<?= json_encode($chart)?>');
	console.log(<?= json_encode($chart)?>);
	$(function () { 
		    
	Highcharts.chart('chart', {
	    title: {
	        text: 'Thống Kê Doanh Số Theo Thời Gian'
	    },
	    xAxis: {
	        categories: chart_info.xAsix
	    },
	    yAxis: [{ // Primary yAxis
	        labels: {
	            format: '{value}',
	            style: {
	                color: Highcharts.getOptions().colors[2]
	            }
	        },
	        title: {
	            text: 'Doanh Số',
	            style: {
	                color: Highcharts.getOptions().colors[2]
	            }
	        },
	        opposite: true

	    }, { // Secondary yAxis
	        gridLineWidth: 0,
	        title: {
	            text: 'Lượng Sản Phẩm',
	            style: {
	                color: Highcharts.getOptions().colors[0]
	            }
	        },
	        labels: {
	            format: '{value}',
	            style: {
	                color: Highcharts.getOptions().colors[0]
	            }
	        }

	    }],

	    series: [{
	    	yAxis:0,
	        type: 'column',
	        name: 'Tổng Hóa Đơn',
	        data: chart_info.sum_money
	    }, {
	    	yAxis:0,
	        type: 'column',
	        name: 'Tổng Nợ',
	        data: chart_info.sum_debt
	    }, {
	    	yAxis:1,
	        type: 'spline',
	        name: 'Số Lượng SP',
	        data: chart_info.sum_qty,
	        marker: {
	            lineWidth: 2,
	            lineColor: Highcharts.getOptions().colors[3],
	            fillColor: 'white'
	        }
	    }]
	});
	});
<?php endif;?>
	window.onload = function(){
		$('.pro_id ').change();
	}

	function update_cart(obj){
		parent = obj.parents('.product-row');
		product = parent.find('select.pro_id option:selected');
		one_price = parent.find('input.one_price');
		qty = parent.find('input.qty');
		sum = parent.find('input.sum');
		one_price.val(product.data('price'));
		sum.val(qty.val()*one_price.val());
		//Check if product_id exist
	}

	function add_product(){
		last_product = $('.product-row').last();
		last_product.after(last_product.clone());
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
			url: '/admin/order/ajax_change_status',
			type: 'post',
			dataType: 'json',
			data: {arr_change: arr_change},
		})
		.done(function(res) {
			if(res[0] == 'success'){
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
</script>

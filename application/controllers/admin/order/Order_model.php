<?php

class Order_model extends CI_Model
{
	private $table = 'orders';
	private $data;
	private $req;
	private $CI;
	// private $get_data;
	function __construct(){
		parent::__construct();
		$this->CI =& get_instance();
	}

	public function fill_data(){
		$this->req['cus_id'] = $this->post_data['cus_id'];
		$this->req['sum'] = $this->post_data['address'];
		$this->req['paid'] = $this->post_data['phone'];
		if(isset($this->post_data['id_admin']))
			$this->req['id_admin'] = $this->post_data['id_admin'];
	}

	public function get_one($ord_id){
		$item = $this->db->select('orders.*,customer.name as cus_name')
			->where('orders.id',$ord_id)
			->join('customer','customer.id = orders.cus_id')
			->get($this->table);
		return $item->row();
	}

// Get all detail by order id
	public function get_detail($ord_id){
		$all_item = $this->db->where('ord_id',$ord_id)
			->get('order_detail');
		return $all_item->result();
	}

	public function get_all($data){
		$all = $this->db->select('orders.*,customer.name as cus_name, customer.id as cus_id, sum(order_detail.qty) as sum_qty ')
			->from($this->table)
			->join('customer','orders.cus_id = customer.id')
			->join('order_detail','orders.id = order_detail.ord_id')
			->group_by('orders.id')
			->order_by('orders.id','desc');
		if(isset($data['time_from']) && isset($data['time_to'])){
			$this->db->where('orders.create_at >=',$data['time_from']);
			$this->db->where('orders.create_at <=',$data['time_to']);
		}
		return $all->get()->result();
	}
// Get chart by time and divide to 10 column
	public function get_chart($from,$to){
		$ret_arr = array();
		$d_from = date_create($from); 
		$d_to = date_create($to);
		$diff = date_diff($d_from,$d_to);
	// Gap beetwen 2 time in chart
		$step = (int) ceil($diff->days/12);
		for($i= 0; $i<= 10; $i++){
			$cur_step = $i*$step;
			$date = date_create($from);
			$date->add(new DateInterval("P{$cur_step}D"));			
			$ret_arr['xAsix'][] = $date->format('y-m-d');
		// Lấy doanh số vs nợ theo 10 mốc thời gian bên trên
			$d_to = $date->format('y-m-d');
			$date->sub(new DateInterval("P{$step}D"));
			$d_from = $date->format('y-m-d'); ;		
			$row_chart = $this->db->query("select sum(sum) as sum_money, sum(pre_paid) as sum_prepaid, sum(sum_qty) as sum_qty from (select orders.*,sum(order_detail.qty) as sum_qty from orders, order_detail where order_detail.ord_id = orders.id group by orders.id) as new_tb where create_at >= '{$d_from}' and create_at <= '{$d_to}' ")->row();
		// Lấy Trong Khoảng $date đến Trước đó $step ngày
			$ret_arr['sum_money'][] = (int) $row_chart->sum_money;
			$ret_arr['sum_debt'][] = $row_chart->sum_money - $row_chart->sum_prepaid;
			$ret_arr['sum_qty'][] = (int) $row_chart->sum_qty;
		}
		return $ret_arr;
	}

	public function get_cate_by_cusid($cus_id){
		$all = $this->db->where('cus_id',$cus_id)
			->order_by('id','desc')
			->get($this->table);
		return $all->result();
	}
	public function create(){
		$this->db->trans_start();
	/*Insert to order */
		// Get array has key is id of product value is quantity
		$arr_product = array_combine($this->post_data['product_id'],$this->post_data['qty']);

		$all_pro = $this->db->where_in('id',array_keys($arr_product))
			->get('product');
		$all_pro = $all_pro->result();
		//Get sum of all product 
		$sum = 0;
		foreach($all_pro as $k => $v){
			$sum += $v->price * $arr_product[$v->id];	
		}
		$orders = array(
				'cus_id' =>	$this->post_data['cus_id'],
				'sum' => $sum,
				'pre_paid' => $this->post_data['pre_paid'],
				'shipper_id' => $this->post_data['shipper_id'],
		);
		$this->db->set($orders)->insert($this->table);
		$ord_id = $this->db->insert_id();
	/*Update debt of customer (if total < 0 it save negative value)*/	
		$total = $sum - $this->post_data['pre_paid'];
		$this->db->set('debt','debt + '.$total,false)
			->where('id',$this->post_data['cus_id'])
			->update('customer');	
		
	/*Insert order_detail*/
		foreach($all_pro as $k => $v){
			//array to insert to order detail
			$array = array(
				'ord_id' => $ord_id,
				'pro_id' => $v->id,
				'price' => $v->price,
				'qty' => (int)$arr_product[$v->id]
			);
			$this->db->insert('order_detail',$array);

		}
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function edit($id){
		$this->db->trans_start();
	// Get array has key is id of product value is quantity
		$arr_product = array_combine($this->post_data['product_id'],$this->post_data['qty']);
		$all_pro = $this->db->where_in('id',array_keys($arr_product))
			->get('product');
		$all_pro = $all_pro->result();

	//Get sum of all product 
		$sum = 0;
		foreach($all_pro as $k => $v){
			$sum += $v->price * $arr_product[$v->id];	
		}

	//Recalculate debt of customer and delete detail
		$this->db->query("update orders, customer as c
			set c.debt = c.debt - (orders.sum - orders.pre_paid)
			where orders.cus_id = c.id and orders.id = {$id}");
		$this->db->where('ord_id',$id)->delete('order_detail');

	//Update orders
		$orders = array(
				'cus_id' =>	$this->post_data['cus_id'],
				'sum' => $sum,
				'pre_paid' =>$this->post_data['pre_paid'],
		);
		$this->db->set($orders)
				->where('id',$id)
				->update('orders');

	/*Update debt of customer*/	
		$total = $sum - $this->post_data['pre_paid'];
		$this->db->set('debt','debt + '.$total,false)
			->where('id',$this->post_data['cus_id'])
			->update('customer');	
		
	/*Update order_detail*/
		foreach($all_pro as $k => $v){
			//array to insert to order detail
			$array = array(
				'ord_id' => $id,
				'pro_id' => $v->id,
				'price' => $v->price,
				'qty' => (int)$arr_product[$v->id]
			);
			$this->db->insert('order_detail',$array);

		}
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

// Change cate of product to 0 before delete cate
	public function delete($ord_id){
		$this->db->trans_start();
		$this->db->query("update orders, customer as c
			set c.debt = c.debt - (orders.sum - orders.pre_paid)
			where orders.cus_id = c.id and orders.id = {$ord_id}");
		// die($this->db->last_query());
		$this->db->where('id',$ord_id)->delete($this->table);
		$this->db->where('ord_id',$ord_id)->delete('order_detail');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

}
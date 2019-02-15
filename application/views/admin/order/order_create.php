<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
       Thêm Đơn Hàng
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $controller?>">Đơn Hàng</a></li>
          <li class="breadcrumb-item active" aria-current="page">Thêm Đơn</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card card-danhmuc mb-4">
          <h4 class="card-header bg-primary text-white">Thêm Thông Tin</h4>
          <div class="card-body">
           
            <?php $this->load->view('admin/master/errors')?>           
            
           <form method="post" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="cus_id">Khách Hàng</label>
                  <select class="form-control" name="cus_id">
                    <?php foreach($all_customer as $item):?>
                      <option value="<?=$item->id?>"><?=$item->name.'-'.$item->phone?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-md-12">
                  <button class="btn btn-primary py-2 px-4 add_pro mdi  mdi-plus-circle" name="add_pro" type="button" style="font-size:20px;" onclick="add_product()"> </button>

                </div>
                <div class="form-row col-md-12 product-row row">
                  <div class="form-group col-md-4">
                    <label for="product_id[]">Sản Phẩm</label>
                    <select class="form-control pro_id text-dark" name="product_id[]" onChange="update_cart($(this))">
                      <?php foreach($all_product as $item):?>
                      <option value="<?=$item->id?>" data-price="<?=$item->price?>"><?=$item->name?></option>
                    <?php endforeach;?>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="price[]">Đơn Giá</label>
                    <input class="one_price form-control" name="price[]" type="text" readonly value="0">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="qty[]">Số Lượng</label>
                    <input class="qty form-control" name="qty[]" type="number" onChange="update_cart($(this))" value="0" >
                  </div>
                  <div class="form-group col-md-3">
                    <label for="sum[]">Tổng</label>
                    <input class="sum form-control" name="sum[]" type="number" readonly>
                  </div>
                  <div class="form-group col-md-1">
                    <label for="delete">Xóa</label>
                    <button class="px-1 py-2 form-control mdi mdi-delete btn btn-danger" name="delete" type="button" onclick="$(this).parents('.product-row').remove()" style="font-size: 25px"> </button>
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <div class="col-md-5 float-right">
                    <label for="pre_paid">Trả Trước</label>
                    <input class="form-control" type="number" name="pre_paid" value="0" >
                  </div>
                </div>
                
                <div class="form-group col-md-12 text-right">
                  <button class="btn btn-success" name="submit_btn">Thêm</button>
                </div>
              </div>
           </form>
          </div> <!-- .card-body -->
        </div> <!-- .card-card-add -->
      </div>
    </div> <!-- .row -->
  </div> <!-- .content-wrapper -->

  <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
  </footer>
</div> <!-- end .main-panel -->
<style type="text/css">
  input[type="checkbox"]{
    width: 20px;
    height: 20px;
  }
  select{
    color:black!important;
  }
</style>
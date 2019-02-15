<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
       Thông Tin Khách Hàng
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $controller?>">Khách Hàng</a></li>
          <li class="breadcrumb-item active" aria-current="page">Thông Tin </li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-md-7 grid-margin">
        <div class="card card-danhmuc mb-4">
          <h4 class="card-header bg-primary text-white">Thông Tin</h4>
          <div class="card-body">

           <!-- Load view of errors-->
            <?php $this->load->view('admin/master/errors')?>         
           <form method="post" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="name">Tên</label>
                  <input class="form-control" name="name" type="text" required value="<?=$mitem->name?>">
                </div>
                <div class="form-group col-md-12">
                  <label for="description">Địa Chỉ</label>
                  <textarea class="form-control" name="address" ><?=$mitem->address?></textarea>
                </div>
                <div class="form-group col-md-12">
                  <label for="name">Email</label>
                  <input class="form-control" name="email" type="email" value="<?=$mitem->email?>" >
                </div>
                <div class="form-group col-md-12">
                  <label for="name">Sdt</label>
                  <input class="form-control" name="phone" type="text" minlength="10" maxlength="11" pattern= "[0-9]{10,11}" title="10 đến 11 ký tự số" value="<?=$mitem->phone?>">
                </div>
                <div class="form-group col-md-12">
                  <label for="avatar">Avatar</label>
                  <div class="img_preview">
                    <img height="200" alt="Image Preview" src="images/avatar/<?=$mitem->avatar?>">
                  </div>
                  <input class="form-control" name="avatar" type="file" onchange="preview_file()" accept="image/*">
                </div>
                <div class="form-group col-md-12 text-right">
                  <button class="btn btn-success" name="submit_btn">Thêm</button>
                </div>
              </div>
           </form>
          </div> <!-- .card-body -->
        </div> <!-- .card-card-danhuc -->
      </div>
      <div class="col-md-5 grid-margin">
        <div class="card card-debt mb-4">
          <h4 class="card-header bg-primary text-white">Kế Toán</h4>
          <div class="card-body">
           <!-- Load view of errors-->
            <?php $this->load->view('admin/master/errors')?> 
            <div class="col-md-12 p-0 my-3">
              Tiền Nợ: <bold><?= number_format($mitem->debt)?></bold>
            </div>        
           <form action='<?=$controller."/pay_debt/$mitem->id"?>' method="post" enctype="multipart/form-data" onsubmit="return confirm('Thanh Toán')">
              
              <div class="form-row">
                <div class="form-group">
                  <label for="money">Tiền Thanh Toán</label>
                  <input class="form-control" type="number" name="money" required>
                </div>
                <div class="form-group float-right">
                  <button class="btn btn-primary float-right" name="btn_submit">Thanh Toán</button>
                </div>
              </div>
           </form>
          </div> <!-- .card-body -->
        </div> <!-- .card .card-debt -->
      </div>
    </div> <!-- .row -->

    <div class="row paid-history" >
      <div class="card col-md-12 mb-4 p-0">
        <h4 class="card-header bg-primary text-white">Lịch Sử Thanh Toán</h4>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-stripped datatable">
              <thead>
                <th>Ngày Tạo</th>
                <th>Tổng Tiền</th>
                <th>Xóa</th>
              </thead>
              <tbody>
                <?php foreach($paid_history as $value):?>
                  <tr>
                    <td><?=$value->created_at?></td>
                    <td><?=$value->money?></td>
                    <td><a href="<?=$controller."/delete_paid_history/$value->id/$mitem->id"?>" onclick="return confirm('X�a Thanh To�n N�y')">Xóa</a></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div> <!-- .paid-history -->

    <div class="row list_order bg-white card pb-3">
      <h4 class="card-header bg-primary text-white">Lịch Sử Mua Hàng</h4>
      <div class="table-responsive card-body pb-1">
       <table class="table table-bordered table-hover datatable">
                  <thead>
                      <th onclick="select_all()">Select</th>
                      <th>Mã đơn</th>
                      <th>Tổng Tiền</th>
                      <th>Đã Thanh Toán</th>
                      <th>Xóa</th>
                      <th>Xem</th>
                  </thead>
                  <tbody>
                      <?php foreach($list_order as $value):?>
                        <tr id="order_<?= $value->id?>" >
                          <td><input class="order_check" type="checkbox" data-id="<?=$value->id?>"></td>
                          <td>0<?= $value->id ?></td>
                          <td><?= number_format($value->sum) ?></td>
                          <td><?= $value->is_paid == 1? 'Có': 'Không' ?></td>
                          <td>
                            <a class="btn btn-danger" href="<?='/admin/order/delete/'.$value->id?>" onclick="return confirm('Xóa Danh Mục Này')">Xóa</a>
                          </td>
                          <td class="edit_cate">
                            <a class="btn btn-success" href="<?= '/admin/order/edit/'.$value->id ?>">Xem</a>
                          </td>
                        </tr>
                      <?php  endforeach;?>
                  </tbody>
       </table>
      </div>
      <div class="col-md-12">
          <button class="btn btn-danger" onclick="ajax_delete()">Delete All Selected</button>
      </div>
    </div>
  </div> <!-- .content-wrapper -->

  <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
  </footer>
</div> <!-- end .main-panel -->

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Đơn Hàng
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=$controller?>/create">Thêm Đơn Hàng</a></li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <!-- Load view of errors-->
        <?php $this->load->view('admin/master/errors')?>
        <div class="card card-list">
          <h4 class="card-header bg-primary text-white">List Đơn Hàng </h4>
          <div class="card-body">
            <div class="row my-3">
              <form class="w-100">

                <div class="row">
                  <div class="col-md-6">
                    <label for="time_from">Thời Gian Từ</label>
                    <input type="date" class="form-control" name="time_from">
                  </div>
                  <div class="col-md-6">
                    <label for="time_from">Đến</label>
                    <input type="date" class="form-control" name="time_to">
                  </div>
                </div>
                <div class="col-md-12 my-3">
                  <button class="btn btn-info float-right">Lọc</button>
                </div>
              </form>
            </div>
          <?php if(isset($this->get_data['time_from']) && isset($this->get_data['time_to'])):?>
            <div class="row my-3">
              <span class="mx-4">Thời Gian:<h4><?= $this->get_data['time_from'].' -> '.$this->get_data['time_to'] ?></h4></span></br>
              <span class="mx-3">Tổng Tiền:<h4 class="text-success"><?= number_format($total_money)?></h4></span></br>
              <span class="mx-3">Tổng Số Lượng:<h4 class="text-success"><?= number_format($total_amount)?></h4></span></br>
              <span class="mx-3">Tổng Nợ:<h4 class="text-danger"><?= number_format($debt)?></h4></span></br>
            </div>
            <div class="row">
              <div id="chart" class="col-md-10 mx-auto" style="min-width: 500px"></div>
            </div>
          <?php endif;?>
            <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <th onclick="select_all()">Select</th>
                    <th>Mã đơn</th>
                    <th>Khách Hàng</th>
                    <th>Tổng Tiền</th>
                    <th>Trả Trước</th>
                    <th>Số Lượng</th>
                    <th>NV Giao Hàng</th>
                    <th>Thời Gian</th>
                </thead>
                <tbody>
                    <?php foreach($all_items as $value):?>
                      <tr id="cate_<?= $value->id?>" >
                        <td><input class="order_check" type="checkbox" data-id="<?=$value->id?>"></td>
                        <td><a href="/admin/order/edit/<?=$value->id?>">0<?= $value->id ?></a></td>
                        <td><a href="/admin/customer/edit/<?=$value->cus_id?>"><?= $value->cus_name ?></a></td>
                        <td><?= number_format($value->sum) ?></td>
                        <td><?= number_format($value->pre_paid)?></td>
                        <td><?= number_format($value->sum_qty)?></td>
                        <td><a href="/admin/user/edit/<?=explode('::', $value->shipper_id)[0]?>"><?=explode('::', $value->shipper_id)[1]?></a></td>
                        <td><?= $value->create_at?></td>
                      </tr>
                    <?php  endforeach;?>
                </tbody>
            </table>
          </div>
          <div class="row">
              <button class="btn btn-danger" onclick="ajax_delete()">Delete All Selected</button>
          </div>
          </div> <!-- .card-body -->
        </div> <!-- .card-list -->
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
  td img{
    width: 50px!important;
    height: 50px!important;
    border-radius:10px!important;
  }
</style>
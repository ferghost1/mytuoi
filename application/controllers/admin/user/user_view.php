<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Sản Phẩm
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=$controller?>/create">Tạo User</a></li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <!-- Load view of errors-->
        <?php $this->load->view('admin/master/errors')?>
        <div class="card card-list">
          <h4 class="card-header bg-primary text-white">List User</h4>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <th class="select_button" onclick="select_all()">Select</th>
                    <th>STT</th>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Tên</th>
                    <th>Địa chỉ</th>
                    <th>Cấp</th>
                    <th>Sdt</th>
                    <th>Trạng Thái</th>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($all_items as $value):?>
                      <tr id="user_<?= $value->id?>" >
                        <td><input class="order_check" type="checkbox" data-id="<?=$value->id?>"></td>
                        <td><?= $i ?></td>
                        <td><img src="images/avatar/<?= $value->avatar ?>"></td>
                        <td> <a href="<?= $controller.'/edit/'.$value->id ?>"><?= $value->username ?></a></td>
                        <td><?= $value->email ?></td>
                        <td><?= $value->name ?></td>
                        <td><?= $value->address ?></td>
                        <td><?php switch ($value->level) {
                          case 2:
                            echo 'Quản Lý';
                            break;
                          case 3:
                            echo 'Nhân Viên';
                            break;
                           case 4:
                            echo 'Giao Hàng';
                            break;
                        } ?>
                        </td>
                        <td><?= $value->phone ?></td>
                        <td><?php switch ($value->active) {
                          case 1:
                            echo '<div class="status_box text-success">Hoạt Động</div>';
                            break;
                          case 0:
                            echo '<div class="status_box text-danger">Bị Khóa</div>';
                            break;
                        } ?>
                          
                        </td>
                      </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
          </div>
          <div class="row">
              <button class="btn btn-danger" onclick="ajax_delete()">Delete All Selected</button>
              <button class="btn btn-info mx-2" onclick="ajax_change_status()">Change Status</button>
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
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Sản Phẩm
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=$controller?>/create">Thêm Sản Phẩm</a></li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <!-- Load view of errors-->
        <?php $this->load->view('admin/master/errors')?>
        <div class="card card-list">
          <h4 class="card-header bg-primary text-white">List Danh Mục</h4>
          <div class="card-body">
            <table class="table table-bordered table-hover datatable">
                <thead>
                    <th>STT</th>
                    <th>Hình</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Mô Tả</th>
                    <th>Xóa</th>
                    <th>Sửa</th>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($all_items as $value):?>
                      <tr id="cate_<?= $value->id?>" >
                        <td><?= $i ?></td>
                        <td><img src="images/uploads/<?= $value->main_img ?>"></td>
                        <td><?= $value->name ?></td>
                        <td><?= number_format($value->price) ?></td>
                        <td><?= $value->description ?></td>
                        <td>
                          <a class="btn btn-danger" href="<?=$controller.'/delete/'.$value->id?>" onclick="return confirm('Xóa Danh Mục Này')">Xóa</a>
                        </td>
                        <td class="edit_cate">
                          <a class="btn btn-success" href="<?= $controller.'/edit/'.$value->id ?>">Sửa</a>
                        </td>
                      </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
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
    width: 70px!important;
    height: 70px!important;
    border-radius:10px!important;
  }
</style>
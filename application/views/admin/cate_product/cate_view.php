<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Danh Mục
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">UI Elements</a></li>
          <li class="breadcrumb-item active" aria-current="page">Typography</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card card-danhmuc mb-4">
          <h4 class="card-header bg-primary text-white">Thêm Danh Mục</h4>
          <div class="card-body">
            <?= validation_errors()?>
            <?php if(isset($error)):?>
                <div class="alert alert-danger"><?=$error?></div>
            <?php endif;?>
            <?php if(isset($noti_success)):?>
                <div class="alert alert-success"><?=$noti_success?></div>
            <?php endif;?>            
            
           <form action="<?= $controller?>/create" method="post">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="cate_name">Tên Danh Mục</label>
                  <input class="form-control" name="cate_name" type="text" >
                </div>
                <div class="form-group col-md-12">
                  <label for="description">Mô Tả</label>
                  <textarea class="form-control" name="description" ></textarea>
                </div>
                <div class="form-group col-md-12 text-right">
                  <button class="btn btn-success" name="submit_add">Thêm</button>
                </div>
              </div>
           </form>
          </div> <!-- .card-body -->
        </div> <!-- .card-card-add -->
        <?php $this->load->view('admin/cate_product/cate_edit')?>
        <div class="card card-listdm">
          <h4 class="card-header bg-primary text-white">List Danh Mục</h4>
          <div class="card-body">
            <table class="table table-bordered table-hover datatable">
                <thead>
                    <th>STT</th>
                    <th>Tên Danh Mục</th>
                    <th>Mô Tả</th>
                    <th>Lượt Dùng</th>
                    <th>Xóa</th>
                    <th>Sửa</th>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($all_items as $value):?>
                      <tr id="cate_<?= $value->id?>" >
                        <td><?= $i ?></td>
                        <td id="cate_name<?=$value->id?>" ><?= $value->name ?></td>
                        <td id="cate_des<?=$value->id?>" ><?= $value->description ?></td>
                        <td><?= $value->count ?></td>
                        <td>
                          <a class="btn btn-danger" href="/admin/cate_product/delete/<?=$value->id?>" onclick="return confirm('Xóa Danh Mục Này')">Xóa</a>
                          
                        </td>
                        <td class="edit_cate">
                          <button class=" btn btn-success" type="button" onclick="edit_cate(<?=$value->id?>)">Sửa</button>
                        </td>
                      </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
          </div> <!-- .card-body -->
        </div> <!-- .card-listdm -->


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

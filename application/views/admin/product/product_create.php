<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
       Thêm Sản Phẩm
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $controller?>">Sản Phẩm</a></li>
          <li class="breadcrumb-item active" aria-current="page">Thêm Sản Phẩm</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card card-danhmuc mb-4">
          <h4 class="card-header bg-primary text-white">Thêm Sản Phẩm</h4>
          <div class="card-body">
            <?= validation_errors()?>
            <?php if(isset($error)):?>
                <div class="alert alert-danger"><?=$error?></div>
            <?php endif;?>
            <?php if(isset($noti_success)):?>
                <div class="alert alert-success"><?=$noti_success?></div>
            <?php endif;?>            
            
           <form method="post" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="name">Tên Sản Phẩm</label>
                  <input class="form-control" name="name" type="text" >
                </div>
                <div class="form-group col-md-12">
                  <label for="description">Mô Tả</label>
                  <textarea class="form-control" name="description" ></textarea>
                </div>
                <div class="form-group col-md-12">
                  <label for="price">Giá</label>
                  <input class="form-control" name="price" type="number" >
                </div>
                <div class="form-group col-md-12">
                  <label for="main_img">Hình</label>
                  <div class="img_preview">
                    <img height="200" alt="Image Preview">
                  </div>
                  <input class="form-control" name="main_img" type="file" onchange="preview_file()"></input>
                </div>
                <div class="form-group col-md-12">
                  <label for="cate_id">Danh Mục</label>
                  <select class="form-control text-dark" name="cate_id">
                  <?php foreach($all_cate as $cate):?>
                    <option value="<?=$cate->id?>"><?=$cate->name?></option>
                  <?php endforeach;?>
                  </select>
                  
                </div>
                <div class="form-group col-md-12 text-right">
                  <button class="btn btn-success" name="submit_add">Thêm</button>
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

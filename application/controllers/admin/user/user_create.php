<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
       Tạo Tài Khoản
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $controller?>">User</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tạo Tài Khoản</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card card-danhmuc mb-4">
          <h4 class="card-header bg-primary text-white">TTin Tài Khoản</h4>
          <div class="card-body">
           
            <?php $this->load->view('admin/master/errors')?>           
            
           <form method="post" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="name">Username</label>
                  <input class="form-control" name="username" type="text" required>
                </div>
                <div class="form-group col-md-12">
                  <label for="name">Password</label>
                  <input id="password" class="form-control" name="password" type="password" onchange="match_pass()" minlength="6" required>
                </div>
                <div class="form-group col-md-12">
                  <label for="name">Password Confirm</label>
                  <input id="repassword" class="form-control" name="repassword" type="password" onchange="match_pass()" required>
                </div>
                <div class="form-group col-md-12">
                  <label for="emai">Email</label>
                  <input class="form-control" name="email" type="email" >
                </div>
                <div class="form-group col-md-12">
                  <label for="name">Tên</label>
                  <input class="form-control" name="name" type="text" >
                </div>
                <div class="form-group col-md-12">
                  <label for="address">Địa Chỉ</label>
                  <textarea class="form-control" name="address" ></textarea>
                </div>
                <div class="form-group col-md-12">
                  <label for="phone">Sdt</label>
                  <input class="form-control" name="phone" type="text" minlength="10" maxlength="11" pattern= "[0-9]{10,11}" title="10 đến 11 ký tự số" >
                </div>
                <div class="form-group col-md-12">
                  <label for="level">Cấp User</label>
                  <select name="level" >
                  <?php if($this->user->level < 2):?>
                    <option value="2">Quản Lý</option>
                  <?php endif;?>
                    <option value="3">Nhân Viên</option>
                    <option value="4">Giao Hàng</option>
                  </select>
                </div>
                <div class="form-group col-md-12">
                  <label for="avatar">Avatar</label>
                  <div class="img_preview">
                    <img height="200" alt="Image Preview">
                  </div>
                  <input class="form-control" name="avatar" type="file" onchange="preview_file()" accept="image/*">
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

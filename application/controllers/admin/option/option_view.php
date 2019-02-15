<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
       Cấu Hình
      </h3>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin row">
        <div class="col-md-12">
          <?php $this->load->view('admin/master/errors')?>  
        </div>
         
        <div class="card card-logo col-md-4 mr-2 px-0" style="height: 500px">
            <h4 class="card-header bg-primary text-white">Thay Đổi Logo Web</h4>
            <div class="card-body px-1" >
              <form action="/admin/option/change_logo" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-12">
                  <label for="logo">Logo</label>
                  <div class="img_preview">
                    <img alt="Image Preview" src="images/layout/<?=$site_option['logo']?>" style="width: 100%">
                  </div>
                  <input class="form-control" name="logo" type="file" onchange="preview_file($(this))" accept="image/*">
                </div>
                <div class="form-group col-md-12 text-right">
                  <button class="btn btn-success" name="submit_btn">Cập Nhật</button>
                </div>
              </form>
            </div>
        </div>
        <!--end .card-logo -->
        <div class="card card-danhmuc mb-4 col-md-7 px-0">
          <h4 class="card-header bg-primary text-white">Sửa Tài Khoản Admin</h4>
          <div class="card-body">
           
                    
            
           <form action="/admin/option/change_admin" method="post" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-check col-md-12">
                  <label>
                       <input name="change_pass" type="checkbox" onchange="change_pw()">
                       Đổi Pass
                  </label>
                </div>
                <div class="change_pass form-group col-md-12">
                  <label for="old_password">Password Cũ</label>
                  <input class="form-control" name="password" type="password"  placeholder="Old Password" >
                </div>
                <div class="change_pass form-group col-md-12">
                  <label for="new_password">Password Mới</label>
                  <input class="form-control" name="new_password" type="password"  placeholder="New Password" onchange="match_pass()">
                </div>
                <div class="change_pass form-group col-md-12">
                  <label for="renew_password">Nhập Lại Password Mới</label>
                  <input class="form-control" name="renew_password" type="password"  placeholder="Confirm New Password" onchange="match_pass()">
                </div>
                <div class="form-group col-md-12">
                  <label for="name">Tên</label>
                  <input class="form-control" name="name" type="text" required value="<?=$this->user->name?>">
                </div>
                <div class="form-group col-md-12">
                  <label for="description">Địa Chỉ</label>
                  <textarea class="form-control" name="address" ><?=$this->user->address?></textarea>
                </div>
                <div class="form-group col-md-12">
                  <label for="name">Email</label>
                  <input class="form-control" name="email" type="email" value="<?=$this->user->email?>" >
                </div>
                <div class="form-group col-md-12">
                  <label for="name">Sdt</label>
                  <input class="form-control" name="phone" type="text" minlength="10" maxlength="11" pattern= "[0-9]{10,11}" title="10 Đến 11 Ký Tư Số" value="<?=$this->user->phone?>">
                </div>
                <div class="form-group col-md-12">
                  <label for="avatar">Avatar</label>
                  <div class="img_preview">
                    <img height="200" alt="Image Preview" src="images/avatar/<?=$this->user->avatar?>">
                  </div>
                  <input class="form-control" name="avatar" type="file" onchange="preview_file($(this))" accept="image/*">
                </div>
                <div class="form-group col-md-12 text-right">
                  <button class="btn btn-success" name="submit_btn">Cập Nhật</button>
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

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
      <div class="col-md-12 grid-margin">
        <div class="card card-danhmuc mb-4">
          <h4 class="card-header bg-primary text-white">Thông Tin</h4>
          <div class="card-body">

           <!-- Load view of errors-->
            <?php $this->load->view('admin/master/errors')?>         
           <form method="post" enctype="multipart/form-data" onsubmit="before_send()">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="username">Username</label>
                  <input class="form-control" name="username" type="text" required value="<?=$mitem->username?>" disabled>
                </div>
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
                  <input class="form-control" name="phone" type="text" minlength="10" maxlength="11" pattern= "[0-9]{10,11}" title="10 Đến 11 Ký Tư Số" value="<?=$mitem->phone?>">
                </div>
                <div class="form-group col-md-12">
                  <label for="level">Cấp User</label>
                  <select name="level">
                    <option value="2" <?=$mitem->level == 2? 'selected':''?>>Quản Lý</option>
                    <option value="3" <?=$mitem->level == 3? 'selected':''?>>Nhân Viên</option>
                    <option value="4" <?=$mitem->level == 4? 'selected':''?>>Giao Hàng</option>
                  </select>
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
      
    </div> <!-- .row -->
  </div> <!-- .content-wrapper -->

  <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright Â© 2017 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
  </footer>
</div> <!-- end .main-panel -->

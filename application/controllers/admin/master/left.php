<div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="javascript:" class="nav-link">
              <div class="nav-profile-image">
                <img src="images/avatar/<?=$this->user->avatar?>" alt="profile">
                <span class="login-status online"></span> <!--change to offline or busy as needed-->              
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2"><?=$this->user->name?></span>
                <span class="text-secondary text-small"><?=$this->auth->arr_user[$this->user->level]['user_type']?></span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
        <?php if($this->user->level == 1 ):?>
          <li class="nav-item">
            <a class="nav-link" href="/admin/option">
              <span class="menu-title">Cấu Hình</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
        <?php endif;?>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Sản Phẩm</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin/cate_product">Danh Mục Sản Phẩm</a></li>
                <li class="nav-item"> <a class="nav-link" href="/admin/product">DS Sản Phẩm</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/customer">
              <span class="menu-title">Khách Hàng</span>
              <i class="mdi mdi-contacts menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/order">
              <span class="menu-title">Đơn Hàng</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
          <?php if($this->user->level <= 2):?>
          <li class="nav-item">
            <a class="nav-link" href="/admin/user">
              <span class="menu-title">User</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>
        <?php endif;?>
        </ul>
      </nav>
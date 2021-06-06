@php
    $get_data = DB::select('SELECT * FROM users WHERE id = ?', [$_SESSION['user_id']]);

@endphp

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <div class="centered">

            <div class="nav_bar_avatar">
              <a href="profile.php">
                <img src="<?php echo !empty($get_data[0]->image) ? asset("images/avatar/". $get_data[0]->image): 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image'; ?>" />
              </a>
            </div>

          </div>
            <h5 class="centered"><?php echo isset($get_data[0]->username)? $get_data[0]->username: ""; ?></h5>
          <li>
          <a class="<?php echo $page_name === 'dashboard' ? 'active': ""; ?>" href="{{ route('dashbaord') }}">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>

          <li class="sub-menu">
            <a class="<?php echo $page_name === 'gallery' ? 'active': ""; ?>" href="{{ url('/admin/gallery') }}">
                <i class="fa fa-desktop"></i>
                <span>Gallery</span>
            </a>
          </li>

          <li class="sub-menu">
                <a class="<?php echo $page_name === 'messages' ? 'active': ""; ?>" href="{{ url('/admin/messages') }}">
                    <i class="fa fa-envelope"></i>
                    <span>Messages</span>
                </a>
          </li>

          <li>
            <a class="<?php echo $page_name === 'about' ? 'active': ""; ?>" href="{{ url('/admin/about') }}">
                <i class="fa fa-user"></i>
                <span>About</span>
            </a>
          </li>

          <li>
            <a class="<?php echo $page_name === 'profile' ? 'active': ""; ?>" href="{{ url('/admin/profile') }}">
                <i class="fa fa-user"></i>
                <span>Profile</span>
            </a>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

@php
    $page_name = "profile";

    use App\Users;

    $page = isset($_GET['p'])? $_GET['p']: 'overview';
@endphp

@extends('admin/layout/master')

@section('title', 'profile')

@section('profile')

@php

    $profile_data = Users::find($_SESSION['user_id']);

@endphp

<div class="row mt padding_edit">
    <div class="col-lg-12">
      <div class="row content-panel">
        <div class="col-md-4 profile-text mt mb centered centered_1">
          <div class="right-divider hidden-sm hidden-xs">
            <h4>5</h4>
            <h6>Vews</h6>
            <h4>3</h4>
            <h6>Messages</h6>
          </div>
        </div>
        <!-- /col-md-4 -->
        <div class="col-md-4 centered centered_2">
          <div class="profile-pic">
            <p><img src="<?php echo !empty($profile_data->image) ? asset("images/avatar/".$profile_data->image): 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image'; ?>" class="img-circle"></p>
          </div>
        </div>
        <!-- /col-md-4 -->
        <div class="col-md-4 profile-text centered_3">
            <h3><?php echo isset($profile_data->username)? $profile_data->username: ""; ?></h3>
            <h6>web developer</h6>
            <p><?php echo isset($profile_data->description)? $profile_data->description: ""; ?></p>
        </div>
        <!-- /col-md-4 -->
      </div>
      <!-- /row -->
    </div>

    <!-- /col-lg-12 -->
    <div class="col-lg-12 mt">
      <div class="row content-panel">
        <div class="panel-heading">
          <ul class="nav nav-tabs nav-justified">

            <li class="<?php echo $page == 'overview'? 'active': ''; ?>">
              <a href="?p=overview">Overview</a>
            </li>

            <li class="<?php echo $page == 'edit'? 'active': ''; ?>">
              <a href="?p=edit">Edit Profile</a>
            </li>

          </ul>
        </div>
        <!-- /panel-heading -->
        <div class="panel-body">
          <div class="tab-content">

          <?php if ($page == "overview") { ?>

              <div class="row">

              </div>

          <?php

          } elseif ($page == "edit") {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $admin_data = Users::find($_SESSION['user_id']);

                $password = empty($_POST['password']) ? $_POST['oldPassword']: password_hash($_POST['password'], PASSWORD_DEFAULT);

                $avatar_name = $_FILES['avatar']['name'];
                $avatar_size = $_FILES['avatar']['size'];
                $avatar_tmp = $_FILES['avatar']['tmp_name'];
                $avatar_type = $_FILES['avatar']['type'];

                $avatar_img = !empty($admin_data->image)? $admin_data->image: "";

                $avatar_name_2 = empty($avatar_name) ? $avatar_img: $avatar_name;
                $avatar = $avatar_name_2 == $avatar_img? $avatar_img: rand(0, 100000) . $avatar_name_2;

                $imageExtensions = array("png", 'jpg', "gif", "jpeg");
                $explode = explode('.', $avatar);
                $img_format = strtolower(end($explode));

                $img_error = !empty($avatar) && !in_array($img_format, $imageExtensions)? "This Extension Is Not Allowed": "";
                $username_error = empty($_POST['username'])? "the username can't be empty!": "";

                if(empty($username_error) && empty($img_error)) {

                    if($avatar !== $avatar_img) {

                        move_uploaded_file($avatar_tmp, "images\avatar\\" . $avatar);
                    }

                    Users::where('id', $_SESSION['user_id'])->update([
                        'username' => $_POST['username'],
                        'password' => $password,
                        'fullName' => $_POST['full-name'],
                        'image' => $avatar,
                        'phone' => $_POST['phone'],
                        'email' => $_POST['email'],
                        'address' => $_POST['address'],
                        'description' => $_POST['description']
                    ]);

                    return redirect()->to('/admin/profile')->send();
                }
            }

            ?>


              <div class="row">
                <div class="col-lg-8 col-lg-offset-2 detailed mt mt_edit">
                  <h4 class="mb_edit">Personal Information</h4>

                  <form role="form" action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="form-horizontal" enctype="multipart/form-data" >

                    {{ csrf_field() }}

                    <div class="form-group">
                      <label class="control-label col-md-2">Avatar</label>
                        <div class="col-md-10">
                          <div class="fileupload fileupload-new" data-provides="fileupload">

                            <div class="fileupload-new thumbnail" id="show_img" style="width: 200px; height: 150px;">
                              <img src="<?php echo isset($profile_data->image)? asset('images/avatar/' . $profile_data->image): ''; ?>" />
                            </div>

                            @if (!empty($img_error))
                                <p class="error image_error"><span>* </span>{{ $img_error }}</p>
                            @endif

                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                              <div>
                                <span class="btn btn-theme02 btn-file">
                                  <span class="fileupload-new select_image"><i class="fa fa-paperclip"></i> Select image</span>
                                  <span class="fileupload-exists change"><i class="fa fa-undo"></i> Change</span>
                                  <input type="file" name="avatar" class="default avatar" id="remove_uploading_value" />
                                </span>
                                <span id="remove_uploading_img" class="btn btn-theme04 fileupload-exists" ><i class="fa fa-trash-o"></i> Remove</span>
                            </div>

                          </div>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Username</label>
                      <div class="col-lg-6">
                        <input type="text" name="username" value="<?php echo isset($profile_data->username)? $profile_data->username: ''; ?>" class="form-control <?php echo isset($username_error)? 'error_effect': ''; ?>">
                        @if (!empty($username_error))
                            <p class="error"><span>* </span>{{ $username_error }}</p>
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Password</label>
                      <div class="col-lg-6">
                        <input type="hidden" name="oldPassword" value="<?php echo !empty($profile_data->password)? $profile_data->password: ''; ?>" />
                        <input type="password" name="password" class="form-control" autocomplete="new-password" />
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>
                        <div class="col-lg-6">
                          <input type="phone" name="phone" value="<?php echo isset($profile_data->phone)? $profile_data->phone: ''; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-6">
                          <input type="email" name="email" value="<?php echo isset($profile_data->email)? $profile_data->email: ''; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Address</label>
                        <div class="col-lg-6">
                          <input type="text" name="address" value="<?php echo isset($profile_data->address)? $profile_data->address: ''; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">FullName</label>
                      <div class="col-lg-6">
                        <input type="text" name="full-name" value="<?php echo isset($profile_data->fullName)? $profile_data->fullName: ''; ?>" class="form-control">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Description</label>
                      <div class="col-lg-10">
                        <textarea name="description" rows="10" cols="30" class="form-control" ><?php echo isset($profile_data->description)? $profile_data->description: ''; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-theme" >Save</button>
                        <button class="btn btn-theme04" type="button">Cancel</button>
                      </div>
                    </div>

                </form>
                </div>
              </div>

            <?php

        }

          ?>

          </div>
          <!-- /tab-content -->
        </div>
        <!-- /panel-body -->
      </div>
      <!-- /col-lg-12 -->
    </div>
    <!-- /row -->
  </div>


@endsection


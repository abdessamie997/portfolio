
@php
    $page_name = "gallery";

    use App\Posts;

    $post_id = isset($_GET['g']) ? $_GET['g']: "0";
    $column = $post_id == '0' ? 'all': 'type';

    if(isset($_GET['delete'])) {

        Posts::where('id', $_GET['delete'])->delete();
    }

    $gallery_data = Posts::where($column, $post_id)->orderBy('id', 'desc')->get();

@endphp

@extends('admin/layout/master')

@section('title', 'gallery')

@section('gallery')

    @if (isset($_GET['add-item']))

        @php
            if($_SERVER['REQUEST_METHOD'] === 'POST') {

                $tmp_image = $_FILES['image']['tmp_name'];
                $image = rand(0, 100000).$_FILES['image']['name'];

                $imageExtensions = array("png", 'jpg', "gif", "jpeg");
                $exp = explode('.', $image);
                $img_format = strtolower(end($exp));

                $img_error = "";
                $img_error   = empty($image) ? "Image File can't be Empty": "";
                $img_error   = !empty($image) && !in_array($img_format, $imageExtensions)? "This Extension Is Not Allowed": "";
                $title_error = empty($_POST['title']) ? "Title Place can't be Empty": "";
                $desc_error  = empty($_POST['description']) ? "Description Place can't be Empty": "";

                if (empty($img_error) && empty($title_error) && empty($desc_error) && empty($img_error)) {

                    move_uploaded_file($tmp_image, "images\works\\".$image);

                    $gallery = new Posts;
                    $gallery->users_id = $_SESSION['user_id'];
                    $gallery->image = $image;
                    $gallery->title = $_POST['title'];
                    $gallery->description = $_POST['description'];
                    $gallery->type = $_POST['type'];
                    $gallery->save();

                    return redirect()->to('/admin/gallery')->send();
                }
            }

        @endphp

        <!------ start add a post form -------->
        <h3><i class="fa fa-angle-right edit_h3_add_items"></i> Add Item</h3>
        <div class="form-panel">
            <form class="cmxform form-horizontal style-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
              <div class="form-group ">
                <label for="title" class="control-label col-lg-2">Title</label>
                <div class="col-lg-10">
                    <input class=" form-control" id="title" name="title" minlength="2" type="text" placeholder="Title" />
                    @if (!empty($title_error))
                        <p class="error"><span>* </span>{{ $title_error }}</p>
                    @endif
                </div>
              </div>

              <div class="form-group">
                <label for="description" class="control-label col-lg-2">Description</label>
                <div class="col-lg-10">
                    <textarea name="description" class="form-control " id="description" placeholder="Description"></textarea>
                    @if (!empty($desc_error))
                        <p class="error"><span>* </span>{{ $desc_error }}</p>
                    @endif
                </div>
              </div>

              <div class="form-group">
                <label for="type" class="control-label col-lg-2">Type</label>
                <div class="col-lg-10 form-row">
                    <select name="type" id="type" class="form-control">
                        <option value="1">Development</option>
                        <option value="2">Design</option>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2">Image Upload</label>
                <div class="col-md-9">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                    </div>
                    @if (!empty($img_error))
                        <p class="error error_image"><span>* </span>{{ $img_error }}</p>
                    @endif
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                    <div>
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                      <input type="file" name="image" class="default" />
                      </span>
                      <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                    </div>
                  </div>

                </div>
              </div>

              <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Save</button>
                    <button class="btn btn-theme04" type="button">Cancel</button>
                  </div>
              </div>

            </form>
        </div>
    <!------ end add a post form -------->

    @elseif (isset($_GET['edit']))

    <!------ start edit a post form -------->

    <?php

        // get posts data for updating it:
        $edit_gallery_data = Posts::find($_GET['edit']);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $img_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $extensions = array("png", 'jpg', "gif", "jpeg");
            $exp = explode('.', $img_name);
            $ext = strtolower(end($exp));

            $image = !empty($_FILES['image'])? rand(0, 100000).$img_name: $edit_gallery_data->image;

            $img_error = !empty($img_name) && !in_array($ext, $extensions) ? "sorry this extention is not accepted": "";
            $title_error = empty($_POST['title']) ? "title place can't be empty": "";
            $desc_error = empty($_POST['description']) ? "description place can't be empty": "";

            if(empty($img_error) && empty($title_error) && empty($desc_error)) {

                if(!empty($img_name)) {

                    move_uploaded_file($tmp_name, "images\works\\".$img_name);
                }

                Posts::where('id', $_GET['edit'])->update([

                    "title" => $_POST['title'],
                    "description" => $_POST['description'],
                    "type" => $_POST['type'],
                    "image" => $image
                ]);

                return redirect()->to("/admin/gallery")->send();
            }
        }
    ?>

    <h3><i class="fa fa-angle-right edit_h3_add_items"></i> Add Item</h3>
    <div class="form-panel">
        <form class="cmxform form-horizontal style-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
            <div class="form-group ">
                <label for="title" class="control-label col-lg-2">Title</label>
                <div class="col-lg-10">
                    <input class=" form-control" value="{{ $edit_gallery_data->title }}" id="title" name="title" minlength="2" type="text" placeholder="Title" />
                    @if (!empty($title_error))
                        <p class="error"><span>* </span>{{ $title_error }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="control-label col-lg-2">Description</label>
                <div class="col-lg-10">
                    <textarea name="description" class="form-control " id="description" placeholder="Description" >{{ $edit_gallery_data->description }}</textarea>
                    @if (!empty($desc_error))
                        <p class="error"><span>* </span>{{ $desc_error }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="type" class="control-label col-lg-2">Type</label>
                <div class="col-lg-10 form-row">
                    <select name="type" id="type" class="form-control">
                        <option value="1" <?php if($edit_gallery_data->type == 1) { echo "selected"; } ?> >Development</option>
                        <option value="2" <?php if($edit_gallery_data->type == 2) { echo "selected"; } ?> >Design</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Image Upload</label>
                <div class="col-md-9">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="<?php echo asset("images/works/" . $edit_gallery_data->image); ?>" alt="" />
                    </div>
                    @if (!empty($img_error))
                        <p class="error image_error"><span>* </span>{{ $img_error }}</p>
                    @endif

                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                    <div>
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                      <input type="file" name="image" class="default" />
                      </span>
                      <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                    </div>
                  </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Save</button>
                    <button class="btn btn-theme04" type="button">Cancel</button>
                </div>
            </div>

        </form>
    </div>
    <!------ end edit a post form -------->

    @else

    <h3><i class="fa fa-angle-right"></i> Gallery </h3>
    <hr>

    <div class="showback showback_1">
        <div class="btn-group btn-group-justified edit_btn_group">
            <a class="btn btn-info <?php echo !isset($_GET['g']) || isset($_GET['g']) && $_GET['g'] == '0' ? 'active': ''; ?>" href='?g=0' > All items </a>
            <a class="btn btn-info <?php echo isset($_GET['g']) && $_GET['g'] == '1' ? 'active': ''; ?>" href="?g=1" >Development</a>
            <a class="btn btn-info <?php echo isset($_GET['g']) && $_GET['g'] == '2' ? 'active': ''; ?>" href="?g=2" >Design</a>
        </div>

        <div class="row mt">
            <div class="mb-2 asc_des">
                <a href="?add-item">
                    <button type="button" class="btn btn-theme02">
                        <i class="fa fa-plus"></i> Add New Item
                    </button>
                </a>
            </div>

        <!-- start Show Items -->
        @foreach ($gallery_data as $item)

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc edit_pan items_cnt">
            <div class="project-wrapper">
                <div class="project">
                    <div class="photo-wrapper">
                        <div class="product_info">
                            <div>
                                <span>{{ $item->title }}</span>
                                <span>{{ $item->description }}</span>
                                <span>Add_Date</span>
                            </div>
                        </div>
                        <div class="photo">
                            <a href="#"><img class="img-responsive" src="<?php echo !empty($item->image) ? asset("images/works/" . $item->image): 'http://www.placehold.it/243x364/EFEFEF/AAAAAA&text=no+image' ?>" ></a>
                        </div>
                        <div class="overlay"></div>
                    </div>
                            <i class="fa fa-ellipsis-v setting_item"></i>
                        <div class="add_delete">
                            <a href='?edit={{ $item->id }}'>Edit Item</a>
                            <a href='?delete={{ $item->id }}' >Delete Item</a>
                        </div>

                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>

@endif

@endsection

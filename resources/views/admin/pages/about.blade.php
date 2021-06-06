
@extends('admin.layout.master')

@section('title', 'about')

@php
    $page_name = "about";

    use App\Skills;
    use App\Experiences;

    $skills = Skills::all();
    $experiences = Experiences::all();
@endphp

@section('about')
    <h1>About</h1>
    <hr>

    @if (isset($_GET['create']))

    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <div class=" form">

                @if ($_GET['create'] == 'skills')

                    <form class="cmxform form-horizontal style-form" action="{{ action('aboutController@store') }}" method="POST" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-2">Skill</label>
                            <div class="col-lg-10">
                                <input class=" form-control" id="title" name="skill" minlength="2" type="text" placeholder="skill" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="number" class="control-label col-lg-2" >degree</label>
                            <div class="col-lg-10">
                                <input class=" form-control" id="number" name="degree" minlength="2" type="text" placeholder="degree" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-theme" type="submit">Save</button>
                                <button class="btn btn-theme04" type="button">Cancel</button>
                            </div>
                        </div>

                    </form>

                @else

                    <form class="cmxform form-horizontal style-form" action="{{ action('aboutController@store') }}" method="POST" >

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-2">Title</label>
                            <div class="col-lg-10">
                                <input class=" form-control" id="title" name="title_exp" minlength="2" type="text" placeholder="Title" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desc" class="control-label col-lg-2" >Experience</label>
                            <div class="col-lg-10">
                                <textarea name="desc_exp" class="form-control " id="desc" placeholder="Experience" required ></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start_date" class="control-label col-lg-2" >From / To</label>
                            <div class="col-lg-10 form-row form_row_2">
                                <input class="form-control" name="start_date" minlength="2" type="date" placeholder="degree" required />
                                <input class="form-control" name="end_date" minlength="2" type="date" placeholder="degree" required />
                            </div>
                        </div>

                        <input type="hidden" name="action" value="experience" >

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-theme" type="submit">Save</button>
                                <button class="btn btn-theme04" type="button">Cancel</button>
                            </div>
                        </div>

                    </form>

                @endif

                </div>
            </div>
        </div>
    </div>

    @else

    <!-- row -->
    <div class="row mt">
        <div class="col-md-6">
          <div class="content-panel">
            <table class="table table-striped table-advance table-hover">

              <div class="panels_header">
                <a class="panel_name"><i class="fa fa-angle-right"></i> Skills</a>
                <a class="add_cat" href="?create=skills">
                  <button type="button" class="btn btn-theme02 btn_add">
                    <i class="fa fa-plus"></i> New Skill
                  </button>
                </a>
              </div>

              <thead class="panel_bar">
                <tr>
                  <th><i class="fa fa-dot-circle-o"></i> Skill</th>
                  <th><i class="fa fa-bookmark"></i> Degree</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                @foreach ($skills as $skill)

                <tr>
                    <td>{{ $skill['skill'] }}</td>
                    <td>% {{ $skill['degree'] }}</td>
                    <td>
                        <a class="btn btn-primary btn-xs btn_delete_edit"><i class="fa fa-pencil"></i></a>
                        <form action="{{ action('aboutController@destroy', $skill['id']) }}" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE" >
                            <button type="submit" class="btn btn-danger btn-xs btn_delete_edit"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                </tr>

                @endforeach

              </tbody>
            </table>
          </div>
        </div>
          <!-- /content-panel -->
        <div class="col-md-6">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">

                <div class="panels_header">
                  <a class="panel_name"><i class="fa fa-angle-right"></i> Experiences</a>
                  <a class="add_cat" href="?create=experience">
                    <button type="button" class="btn btn-theme02 btn_add">
                      <i class="fa fa-plus"></i> New Experience
                    </button>
                  </a>
                </div>

                <thead class="panel_bar">
                  <tr>
                    <th><i class="fa fa-dot-circle-o"></i> Experiences</th>
                    <th><i class="fa fa-bookmark"></i> date</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>

                  @foreach ($experiences as $experience)

                    <tr>
                        <td style="width:60%">
                            <span class="expe_title">{{ $experience['title']}}</span>
                            <br>{{$experience['description'] }}
                        </td>
                        <td>{{ $experience['from']}}<br>{{$experience['to']}}</td>
                        <td>
                            <a class="btn btn-primary btn-xs btn_delete_edit"><i class="fa fa-pencil"></i></a>
                            <form action="{{ action('aboutController@destroy', $experience['id']) }}" method="POST" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" >
                                <input type="hidden" name="exp" value="0" >
                                <button type="submit" class="btn btn-danger btn-xs btn_delete_edit"><i class="fa fa-trash-o "></i></button>
                            </form>
                        </td>
                    </tr>

                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- /content-panel -->
        </div>
    </div>

    @endif
@endsection

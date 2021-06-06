<?php

    $page_name = "dashboard";

    use App\views;
    use App\Messages;

    // destroy session if last admin activity > 10 minut
    if(isset($_SESSION['last-activity']) && (time() - $_SESSION['last-activity'] > (60 * 60))) {

        session_unset();
        session_destroy();
    }

    $_SESSION['last-activity'] = time();

?>

@extends('admin/layout/master')

@section('title', 'dashboard')

@section('dashboard')

    <div class="row">
        <div class="col-lg-9 main-chart main_chart_editing">

            <div class="col-md-6 mb statistic">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ count(views::all()) }}</h3>
                        <p>Views</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-eye"></i>
                    </div>
                    <a href="items.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-6 mb statistic">
                <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{ count(Messages::all()) }}</h3>
                      <p>Messages</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-comments"></i>
                    </div>
                    <a href="{{ url("/admin/messages") }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
        <!-- /col-lg-9 END SECTION MIDDLE -->
        <!-- **********************************************************************************************************************************************************
        RIGHT SIDEBAR CONTENT
        *********************************************************************************************************************************************************** -->
        <div class="col-lg-3 ds">
            <!-- First Messages -->
            @php
                $messages = Messages::orderBy('id', 'desc')->take(3)->get();
            @endphp

            <h4 class="centered mt">RECENT ACTIVITY</h4>

            @if($messages == '[]')
                <p class="text-center no_message" >There are no messages !</p>
            @endif

            @foreach ($messages as $message)

                <div class="desc">

                    <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-envelope"></i></span>
                    </div>

                    <div href="#" class="details">
                        <p>

                        <a href="{{ url("/admin/messages?open=$message->id") }}">{{ $message->name }}</a><br/>
                            <span>{{ $message->subject }}</span>
                        </p>

                        <span class="cnt_btn_s_delete_valid float-right">
                            <a class="btn btn-danger btn-xs btn_delete" href="{{ url("/admin/messages?delete=$message->id") }}"><i class="fa fa-trash fa-x2"></i></a>
                        </span>
                    </div>
                </div>

            @endforeach

            <!-- / USERS ONLINE SECTION -->
            <h4 class="centered mt">RECENT ACTIVITY</h4>
            <!-- First views -->

            @php
                $views = views::orderBy('id', 'desc')->take(3)->get();
            @endphp

            @if($views == '[]')
                <p class="text-center no_message" >There are no views !</p>
            @endif

            @foreach ($views as $view)

            <div class="desc">
                <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-eye"></i></span>
                </div>
                <div class="details">
                    <p>
                        <span>New view</span>
                        <br/>
                        <a href="#">{{ $view->created_at }}</a><br/>
                    </p>
                </div>
            </div>

            @endforeach
        </div>
    <!-- /col-lg-3 -->
    </div>

@endsection


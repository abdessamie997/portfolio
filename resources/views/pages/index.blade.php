
@php

    use App\views;

    if(!isset($_SESSION['abdessamie-view'])) {

        // views insert
        $views = new views;
        $views->save();

        $_SESSION['abdessamie-view'] = 'view';
    }

    // destroy session if last user activity > 10 minut
    if(isset($_SESSION['last-activity']) && (time() - $_SESSION['last-activity'] > 600)) {

        unset($_SESSION['abdessamie-view']);
    }

    $_SESSION['last-activity'] = time();

@endphp

@extends('layout.master')


@section('title', 'home')

@section('gallery')

<div class="works row">

    @php
        use App\Posts;

        $limit = 6;

        $to = isset($_GET['page']) ? (int)$_GET['page']  * $limit: $limit;

        $from = (int)$to - $limit;

        $posts = Posts::orderBy('id', 'desc')->skip($from)->take($limit)->get();

    @endphp

    @if($posts == "[]")
        <h6>Not Exist any Element for show it !</h6>
    @endif

    @foreach ($posts as $post)

        <div class="product">
            <div class="img">
                <img src="<?php echo asset("images/works/" . $post->image); ?>" alt="">
            </div>
            <div class="info">
                <i class="fa fa-external-link"></i>
                <div>
                    <h6>{{ $post->title }}</h6>
                    <p>{{ $post->description }}</p>
                </div>
            </div>
        </div>

    @endforeach

</div>

<section>

    @php
        $count = count(Posts::all()) / $limit;

        $page_num = isset($_GET['page'])? $_GET['page']: 1;

    @endphp

    @for ($i = 0; $i < ceil($count); $i++)

        <a class="<?php echo (int)$page_num  == (int)($i + 1) ? 'limit-items': ''; ?>" href="?page={{ $i + 1 }}">{{ $i + 1 }}</a>

    @endfor

</section>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('admin.layout.links')

    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

    @include('admin.layout.header')
    @include('admin.layout.navbar')

    {{-- start work space --}}

    <section id="main-content" >
        <section class="wrapper site-main-height" id="main_container" >

            @yield('dashboard')

            @yield('gallery')

            @yield('profile')

            @yield('messages')

            @yield('about')

        </section>
    </section>

    {{-- end work space --}}

    @include('admin.layout.footer')
    @include('admin.layout.scripts')

</body>
</html>


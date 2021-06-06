
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!--external css-->
    <link href="{{ asset("lib/font-awesome/css/font-awesome.css") }}" rel="stylesheet" />
    <link rel="stylesheet" href=" {{ asset("css/layout/bootstrap.min.css") }} ">

    <link rel="stylesheet" href=" {{ asset("css/app.css") }} ">

    <meta name="csrf-token" id="token" contain="{{ csrf_token() }}">

</head>
<body onload="load_function()">

    <div class="loading-icon" >
        <img style="width: 80px;" src="{{ asset("images/logo/mylogo.svg") }}" alt="">
    </div>

    <script>
        function load_function() {

            document.querySelector(".loading-icon").style.display = "none";
            document.querySelector('#parent-of-all-pages').style.display = "block";
        };
    </script>

    <div class="parent-of-all-pages" id="parent-of-all-pages" >
        <div class="parent-two">

            @include('layout.header')

            <div class="parent-three">
                <div class="container">

                    @include('layout.navbar')

                    <main>
                        @yield('gallery')
                        @yield('about')
                        @yield('contact')
                    </main>

                    <footer>
                        <hr>

                        <p>
                            Copyright &copy; 2020 Abdessamie.Depeloper All Rights Reserved
                        </p>

                    </footer>
                </div>
            </div>

        </div>
    </div>

    <script src=" {{ asset("js/app.js") }} "></script>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset("lib/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("lib/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src=" {{ asset("js/layout/smooth-scroll.min.js") }} "></script>

    <script src=" {{ asset("js/layout/main.js") }} "></script>

</body>
</html>

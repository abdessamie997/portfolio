
<section id="container" id="container_hide">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="index.html" class="logo"><b>DASH<span>IO</span></b></a>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">

            <?php
                use App\Messages;
                $msgs = Messages::where('read', 0)->take(5)->get();
            ?>

            <li id="header_inbox_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-theme">{{ count($msgs) > 0 ? count($msgs): "" }}</span>
                </a>

                <ul class="dropdown-menu extended inbox">
                    <div class="notify-arrow notify-arrow-green"></div>

                    <li>
                        <p class="green">You have {{ count($msgs) }} new messages</p>
                    </li>

                    @foreach ($msgs as $msg)

                    <li>
                        <a href="{{ url("/admin/messages?open=$msg->id") }}">
                            <span class="subject">
                                <span class="from">{{ $msg->name }}</span>
                                <span class="time">{{ $msg->created_at }}</span>
                            </span>
                            <span class="message">
                                {{ $msg->subject }}
                            </span>
                        </a>
                    </li>

                    @endforeach

                    <li>
                        <a href="{{ url('/admin/messages') }}">See all messages</a>
                    </li>
                </ul>
            </li>

          <!-- inbox dropdown end -->
          <!-- notification dropdown start-->

            @php
                use App\views;

                $views = views::orderBy('id', 'desc')->take(3)->get();

            @endphp

            <li id="header_notification_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle">
                    <i class="fa fa-eye"></i>
                    <span class="badge bg-warning">{{ count($views) ? count($views): "" }}</span>
                </a>

                <ul class="dropdown-menu extended notification">
                    <div class="notify-arrow notify-arrow-yellow"></div>
                    <li>
                        <p class="yellow">You have {{ count($views) }} new Views</p>
                    </li>

                    @foreach ($views as $view)

                    <li>
                        <a >
                            <span class="label label-success"><i class="fa fa-plus"></i></span>
                            New View
                            <span class="small italic">{{ $view->created_at }}</span>
                        </a>
                    </li>

                    @endforeach

                    <li>
                        <a href="{{ url('/admin') }}">See all notifications</a>
                    </li>
                </ul>

            </li>
          <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li><a class="logout" href="{{ route('logout') }}">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->

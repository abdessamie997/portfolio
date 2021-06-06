
<div class="container">

    <header>

        <div id="header">

            <div class="logo-section">
                <div class="logo">
                    <img src="{{ asset("images/logo/mylogo.svg") }}" alt="">
                    {{-- <p>Abdessamie<span>.Developer</span></p> --}}
                </div>
            </div>

            <div class="welcome-text">
                @php
                    define("GREETING", "You're Welcome in my profile");
                @endphp
                <h1> {{ GREETING }} <span>!</span></h1>
            </div>

            <a href="#profile" class="scroll-down">
                <div class="scroll"></div>
            </a>

        </div>

        <div id="profile" class="profile">
            <div class="img-profile-cnt">
                <div>
                    <img src="{{ asset("images/avatar/8919.jpg") }}" alt="">
                </div>
            </div>
            <h2>
                <span>ABDESSAMIE SALMI</span>
                <br>
                Full Stack Web Developer And Graphic Designer
            </h2>
        </div>

    </header>

</div>

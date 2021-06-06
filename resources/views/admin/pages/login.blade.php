
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>

    @include('admin.layout.links')
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}" />

</head>
<body>

    <div id="login-page">
        <div class="container">
            <div class="form-login">

                <h2 class="form-login-heading">sign in now</h2>
                <div class="login-wrap">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" autofocus>
                    <br>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <br>
                    <button id="submit_button" class="btn btn-theme btn-block save-data" ><i class="fa fa-lock"></i> SIGN IN</button>
                </div>
                <p class="error-message"></p>
            </div>

        </div>
    </div>

    <script>

        var submit_button = document.getElementById('submit_button');

        submit_button.onclick = function() {

            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var _token   = document.getElementById('token').getAttribute('content');

            var errorMessage = document.querySelector('.error-message');

            var my_Request = new XMLHttpRequest();

            my_Request.onreadystatechange = function() {

                if(this.readyState === 4 && this.status === 200) {

                    var $result = this.responseText;

                    if($result == 1) {

                        window.location.reload(0);
                    } else {

                        errorMessage.innerHTML = `<span>*</span>${$result}`;
                    }
                }
            };

            my_Request.open('post', './verify_login', true);
            my_Request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            my_Request.send("user=" + username + "&pass=" + password + "&_token=" + _token);
        }
    </script>

</body>
</html>


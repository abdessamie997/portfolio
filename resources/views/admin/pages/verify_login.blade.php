<?php

    use App\Users;

    $username = $_POST['user'];
    $password = $_POST['pass'];

    $get_userdata = Users::where('username', $username)->get()->take(1);

    $count = count($get_userdata);

    foreach ($get_userdata as $user) {

        if($count > 0 && password_verify($password, $user['password'])) {

        $_SESSION['username'] = $username;
        $_SESSION['user_id']  = $user['id'];

        echo $count;

        } else {
            echo "there's info are not exist";
        }
    }

?>

<?php
session_start();

// require database connection

require_once ('../core/db_connection.php');
include_once ('../View/login.html');

if (isset($_POST['login']) && $_SERVER['REQUEST-METHOD'] = 'POST') {
    # code...
    $connection = dbconfiguration();

    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
    $password = htmlspecialchars($_POST["passcode"], ENT_QUOTES, "UTF-8");

    $table = "SELECT * FROM users WHERE username = '$username' AND passcode = '$password'";
    $results = mysqli_query($connection, $table);

    if ($results && mysqli_num_rows($results) > 0) {
        # code...
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

        header('location: index.php');
    }else{
        echo "wrong login";
    }
}
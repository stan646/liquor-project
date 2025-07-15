<?php
session_start();

if (!$_SESSION["username"]) {
    # code...
    echo "login fail";
    header('location: login.php');
}

require_once ('../core/db_connection.php');
include_once ('../View/index.html');
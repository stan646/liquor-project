<?php
// session for security purpose
session_start();

if (!$_SESSION['username']) {
    # code...
    header('location: login.php');
}
// includes external files
require_once ('../core/db_connection.php');
include_once ('../View/managestock.html');

// function for holding fetching data from database

function fetching(){
    $connection = dbconfiguration();

    $table_fetch_data = "SELECT * FROM products";
    $fetch_results = mysqli_query($connection, $table_fetch_data);
    $products_stock = [];
    if (mysqli_num_rows($fetch_results) > 0) {
        # code...
        while($row = mysqli_fetch_assoc($fetch_results)){
            $products_stock[] = $row;
        }
    }
    return $products_stock;
}


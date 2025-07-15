<?php
session_start();

if (!$_SESSION['username']) {
    # code...
    header('location: login.php');
}

require_once ('../core/db_connection.php');
include_once ('../View/recordsales.html');

// 
function fetchproducts(){
    $connection = dbconfiguration();
    $products = "SELECT * FROM products";
    $results = mysqli_query($connection, $products);
    $products = [];
    if (mysqli_num_rows($results) > 0) {
        # code...
        while($row = mysqli_fetch_assoc($results)){
            $products[] = $row;
        }
    }
    return $products;
}

// 

function recordsalesinputs(){
    if (isset($_POST['save']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

        $connection = dbconfiguration();

        $product_id = $_POST['product_id'];
        // $product_category = $_POST['category_id']; // make sure you have this field
        $quantity_sold = $_POST['quantity_sold'];

        // Step 1: Get the selling price
        $query = mysqli_query($connection, "SELECT selling_price FROM products WHERE id = $product_id");

        if ($query) {
            $product = mysqli_fetch_assoc($query);
            $selling_price = $product['selling_price'];
        } else {
            echo "Query error: " . mysqli_error($connection);
            exit;
        }

        // Step 2: Calculate total price
        $total_price = $quantity_sold * $selling_price;

        // Step 3: Insert into sales table
        $insert = "INSERT INTO sales (product_id, quantity_sold, selling_price, total_price)
                   VALUES ($product_id, $quantity_sold, $selling_price, $total_price)";
        $insert_query = mysqli_query($connection, $insert);

        if ($insert_query) {
            // Step 4: Update stock
            $update = "UPDATE products SET quantity = quantity - $quantity_sold WHERE id = $product_id";
            $update_query = mysqli_query($connection, $update);

            if ($update_query) {
                echo "<div class='container alert alert-success alert-dismissible' 
                style='width:350px; margin-left:-125px; position:fixed; top:55px; left:55%;'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Mauzo yamehifadhiwa kikamilifu</strong> </div>";
            } else {
                echo "<div class='container alert alert-danger alert-dismissible' 
                style='width:350px; margin-left:-125px; position:fixed; top:55px; left:55%;'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Stock ku update</strong> </div>" . mysqli_error($connection);
            }
        } else {
            echo "<div class='container alert alert-danger alert-dismissible' 
                style='width:350px; margin-left:-125px; position:fixed; top:55px; left:55%;'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Mauzo yameshindwa kuhifadhiwa!</strong> </div>" . mysqli_error($connection);
        }
    }
}

recordsalesinputs();

// display data

function displaydata(){
    $connection = dbconfiguration();

    $data_table = "SELECT * FROM sales";
    $query_results = mysqli_query($connection, $data_table);
    $sales_records = [];
    if (mysqli_num_rows($query_results) > 0) {
        # code...
        while ($row = mysqli_fetch_assoc($query_results)) {
            # code...
            $sales_records[] = $row;
        }
        return $sales_records;
    }
}

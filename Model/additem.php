<?php
// login security validation
session_start();
if (!$_SESSION['username']) {
    # code...
    header('location: login.php');
}

// inlcudes and required external files;
require_once ('../core/db_connection.php');
include_once ('../View/additem.html');

// receiving user inputs from the form

if  (isset($_POST["add"]) && $_SERVER['REQUEST_METHOD'] == "POST"){
    # code...
    $connection = dbconfiguration();
    
    $product_name = htmlspecialchars($_POST["product_item"], ENT_QUOTES, "UTF-8");
    $product_category = htmlspecialchars($_POST["category"], ENT_QUOTES, "UTF-8");
    $product_uniti = htmlspecialchars($_POST["Uniti"], ENT_QUOTES, "UTF-8");
    $product_per_pcs = htmlspecialchars($_POST["piece"], ENT_QUOTES, "UTF-8");
    $product_quantity = htmlspecialchars($_POST["quantity"], ENT_QUOTES, "UTF-8");
    $product_buying_price = $_POST["buying_price"];
    $product_total_price = $_POST["total_price"];
    $product_selling_price = $_POST["selling_price"];
    // $product_created_at = Date();

    // validate fields

    if ($product_name === "" || $product_category === "" || $product_uniti === "" || $product_per_pcs === "" ||
            $product_quantity === "" || $product_buying_price === "" || $product_total_price == "" || $product_selling_price === "") {
        # code...
        echo "<div class='container alert alert-danger alert-dismissible' 
                style='width:350px; margin-left:-125px; position:fixed; top:55px; left:55%;'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Kuna tatizo!</strong> </div>";
    }else{

        // save inputs into the specific table into database

        $save_item_table = "INSERT INTO products (product_item, category, Uniti, piece, quantity, buying_price, total_price, selling_price)
        VALUES ('$product_name', '$product_category', '$product_uniti', '$product_per_pcs', '$product_quantity', '$product_buying_price', '$product_total_price', '$product_selling_price')";

        $check_data = mysqli_query($connection, $save_item_table);
        if ($check_data === true) {
        # code...
            echo "<div class='container alert alert-success alert-dismissible' 
                style='width:350px; margin-left:-125px; position:fixed; top:55px; left:55%;'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Umeongeza $product_name $product_uniti $product_quantity kwenye stock!</strong> </div>";
        }else{
            echo "<div class='container alert alert-danger alert-dismissible' 
                style='width:350px; margin-left:-125px; position:fixed; top:55px; left:55%;'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Kuna tatizo!</strong> </div>";
        }
    }
    


    
}
?>

<!-- javascript -->

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null,null,window.location.href);
    }
    // calculating total for quantity and buying price

quantity.addEventListener('input', calculateTotal);
buying_price.addEventListener('input', calculateTotal);

function calculateTotal() {
  const quantity1 = Number(quantity.value);
  const buyingprice1 = Number(buying_price.value);
  Total_price = quantity1 * buyingprice1;
  total_price.value = Total_price.toLocaleString();
  
}

</script>
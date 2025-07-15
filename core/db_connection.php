<!-- db connection -->

<?php
function dbconfiguration(){

    $servername = '127.0.0.1';
    $username = 'root';
    $password = '';
    $dbname = 'liquor_db';

    $connecton = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connecton) {
        # code...
        echo "<script>alert('databse connection error')</script>";
    }

    return($connecton);

}

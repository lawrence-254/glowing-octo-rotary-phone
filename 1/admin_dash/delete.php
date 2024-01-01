<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    //delete
    $delete_v = "DELETE FROM `vehicles` WHERE vehicle_id = $delete_id";
    $result_del = mysqli_query($con, $delete_v);
    if ($result_del) {
        echo "<script>alert('Vehicle deleted successfully')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}

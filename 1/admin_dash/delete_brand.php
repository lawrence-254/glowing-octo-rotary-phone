<?php
if (isset($_GET['delete_brand'])) {
    $delete_brand = $_GET['delete_brand'];

    $delete_query = "DELETE FROM `brand` WHERE brand_id=$delete_brand";
    $result_del = mysqli_query($con, $delete_query);
    if ($result_del) {
        echo "<script>alert('Brand deleted successfully')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}

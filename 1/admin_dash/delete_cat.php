<?php
if (isset($_GET['delete_cat'])) {
    $delete_cat = $_GET['delete_cat'];

    $delete_query = "DELETE FROM `category` WHERE category_id=$delete_cat";
    $result_del = mysqli_query($con, $delete_query);
    if ($result_del) {
        echo "<script>alert('Category deleted successfully')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}

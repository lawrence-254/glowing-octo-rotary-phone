<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/connect.php');

if (isset($_POST['insert_category'])) {
    $category_title = $_POST['cat_title'];

    // Prepare the SELECT statement
    $select_query = "SELECT * FROM category WHERE category_title=?";
    $stmt = mysqli_prepare($con, $select_query);
    mysqli_stmt_bind_param($stmt, "s", $category_title);
    mysqli_stmt_execute($stmt);
    $result_select = mysqli_stmt_get_result($stmt);

    $number = mysqli_num_rows($result_select);
    if ($number > 0) {
        echo "<script>alert('Category exists')</script>";
    } else {
        // Prepare the INSERT statement
        $insert_query = "INSERT INTO category (category_title) VALUES (?)";
        $stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt, "s", $category_title);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>alert('Category has been added')</script>";
        }
    }
}
?>
<h2 class="text-center">Insert Category</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert category" aria-label="Category" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-3 m-auto">
        <input type="submit" class="form-control bg-info" name="insert_category" value="Insert Category">
    </div>
</form>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_GET['edit_brand'])) {
    $id_brand_edit = $_GET['edit_brand'];
    $select_brand = "SELECT * FROM `brand` WHERE brand_id = $id_brand_edit";
    $results = mysqli_query($con, $select_brand);
    $row = mysqli_fetch_assoc($results);
    $title = $row['brand_title'];
}
if (isset($_POST['brand_update'])) {
    $brand_title = $_POST['brand_title'];
    $brand_update_query = "UPDATE `brand` SET brand_title= '$brand_title' WHERE brand_id = $id_brand_edit";
    $update_results = mysqli_query($con, $brand_update_query);
    if ($update_results) {
        echo "<script>alert('Update successful')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}
?>
<div class="container mt-5">
    <h1 class="text-center text-warning">Edit Brand</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline my-5 w-75 m-auto">
            <label for="brand_title">Brand Title</label>
            <input type="text" name="brand_title" id="brand_title" value="<?php echo $title ?>" class="form-control" required="required">
        </div>
        <input type="submit" name="brand_update" value="Brand Category" class="btn btn-warning px-4 mb-3">
    </form>
</div>
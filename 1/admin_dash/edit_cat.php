<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_GET['edit_cat'])) {
    $id_cat_edit = $_GET['edit_cat'];
    $select_cats = "SELECT * FROM `category` WHERE category_id = $id_cat_edit";
    $results = mysqli_query($con, $select_cats);
    $row = mysqli_fetch_assoc($results);
    $title = $row['category_title'];
}
if (isset($_POST['cat_update'])) {
    $cat_title = $_POST['cat_title'];
    $cat_update_query = "UPDATE `category` SET category_title= '$cat_title' WHERE category_id = $id_cat_edit";
    $update_results = mysqli_query($con, $cat_update_query);
    if ($update_results) {
        echo "<script>alert('Update successful')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}
?>
<div class="container mt-5">
    <h1 class="text-center text-warning">Edit Category</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline my-5 w-75 m-auto">
            <label for="cat_title">Category Title</label>
            <input type="text" name="cat_title" id="cat_title" value="<?php echo $title ?>" class="form-control" required="required">
        </div>
        <input type="submit" name="cat_update" value="Update Category" class="btn btn-warning px-4 mb-3">
    </form>
</div>
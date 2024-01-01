<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_GET['edit'])) {
    $get_edit_id = $_GET['edit'];
    $get_vehicles = "SELECT * FROM `vehicles` WHERE vehicle_id = $get_edit_id";
    $stmt = mysqli_prepare($con, $get_vehicles);
    if (!$stmt) {
        throw new Exception("Error in preparing the SQL query: " . mysqli_error($con));
    }

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Error executing the SQL query: " . mysqli_error($con));
    }
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $title = $row['vehicle_title'];
    $description = $row['vehicle_description'];
    $plate = $row['vehicle_reg'];
    $category = $row['category_id'];
    $brand = $row['brand_id'];
    $img1 = $row['vehicle_image1'];
    $img2 = $row['vehicle_image2'];
    $img3 = $row['vehicle_image3'];
    $rate = $row['vehicle_price'];

    // category
    $get_category = "SELECT * FROM `category` WHERE category_id = $category";
    $result_category = mysqli_query($con, $get_category);
    $row_cat = mysqli_fetch_assoc($result_category);
    $cat_title = $row_cat['category_title'];
    // brand
    $get_brand = "SELECT * FROM `brand` WHERE brand_id = $brand";
    $result_brand = mysqli_query($con, $get_brand);
    $row_brand = mysqli_fetch_assoc($result_brand);
    $brand_title = $row_brand['brand_title'];
}

?>
<div class="container mt-5">
    <h1 class="text-center text-warning">Edit Vehicle</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-75 m-auto mb-4">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" required="required" value=<?php echo $title ?>>
        </div>
        <div class="form-outline w-75 m-auto mb-4">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" name="description" class="form-control" required="required" value="<?php echo $description ?>">
        </div>
        <div class="form-outline w-75 m-auto mb-4">
            <label for="registration" class="form-label">Registration</label>
            <input type="text" id="registration" name="registration" class="form-control" required="required" value="<?php echo $plate ?>">
        </div>
        <div class="form-outline w-75 m-auto mb-4">
            <label for="category" class="form-label">Category</label>
            <select name="category" class="form-select">
                <option value="<?php echo $cat_title ?>"><?php echo $cat_title ?></option>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                $get_all_category = "SELECT * FROM `category`";
                $result_all_category = mysqli_query($con, $get_all_category);
                while ($rows_cat = mysqli_fetch_assoc($result_all_category)) {
                    $titles = $rows_cat['category_title'];
                    $cat_id = $rows_cat['category_id'];
                    echo "<option value='$cat_id'>$titles</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-75 m-auto mb-4">
            <label for="brand" class="form-label">Brand</label>
            <select name="brand" class="form-select">
                <option value="<?php echo $brand_title ?>"><?php echo $brand_title ?></option>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                $get_all_brand = "SELECT * FROM `brand`";
                $result_all_brand = mysqli_query($con, $get_all_brand);
                while ($row_all_brand = mysqli_fetch_assoc($result_all_brand)) {
                    $titles = $row_all_brand['brand_title'];
                    $brand_id = $row_all_brand['brand_id'];
                    echo "<option value='$brand_id'>$titles</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-75 m-auto mb-4">
            <label for="image1" class="form-label">Image 1</label>
            <div class="d-flex">
                <input type="file" id="image1" name="image1" class="form-control w-90 m-auto" required="required">
                <img src="../admin_dash/vehicle_images/<?php echo $img1 ?>" alt=<?php echo $title ?> class="v_img">
            </div>
        </div>
        <div class="form-outline w-75 m-auto mb-4">
            <label for="image2" class="form-label">Image 2</label>
            <div class="d-flex">
                <input type="file" id="image2" name="image2" class="form-control w-90 m-auto" required="required">
                <img src="../admin_dash/vehicle_images/<?php echo $img2 ?>" alt=<?php echo $title ?> class="v_img">
            </div>
        </div>
        <div class="form-outline w-75 m-auto mb-4">
            <label for="image3" class="form-label">Image 3</label>
            <div class="d-flex">
                <input type="file" id="image3" name="image3" class="form-control w-90 m-auto" required="required">
                <img src="../admin_dash/vehicle_images/<?php echo $img3 ?>" alt=<?php echo $title ?> class="v_img">
            </div>
        </div>
        <div class="form-outline w-75 m-auto mb-4">
            <label for="rate" class="form-label">Rate</label>
            <input type="text" id="rate" name="rate" class="form-control" required="required" value=<?php echo $rate ?>>
        </div>
        <div class="text-center">
            <input type="submit" value="Update Edit" name="edit" class="btn btn-warning px-3">
        </div>
    </form>
</div>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['edit'])) {
    $v_title = $_POST['title'];
    $v_description = $_POST['description'];
    $v_registration = $_POST['registration'];
    $v_category = $_POST['category'];
    $v_brand = $_POST['brand'];
    $v_rate = $_POST['rate'];

    $v_image1 = $_FILES['image1']['name'];
    $v_image2 = $_FILES['image2']['name'];
    $v_image3 = $_FILES['image3']['name'];

    $temp_image1 = $_FILES['image1']['tmp_name'];
    $temp_image2 = $_FILES['image2']['tmp_name'];
    $temp_image3 = $_FILES['image3']['tmp_name'];

    //verifying
    if (empty($v_title) || empty($v_description) || empty($v_registration) || empty($v_category) || empty($v_brand) || empty($v_rate)) {
        echo "<script>alert('Make sure all fields are filled')</script>";
    } elseif (empty($v_image1) || empty($v_image2) || empty($v_image3)) {
        // Handle the case when any of the image fields are empty
        echo "<script>alert('All images are required')</script>";
    } else {
        $target_dir = "./vehicle_images/";
        move_uploaded_file($temp_image1, $target_dir . $v_image1);
        move_uploaded_file($temp_image2, $target_dir . $v_image2);
        move_uploaded_file($temp_image3, $target_dir . $v_image3);

        //update
        $edit = "UPDATE `vehicles` SET vehicle_title='$v_title', vehicle_description='$v_description' vehicle_reg='$v_registration' category_id='$v_category',brand_id='$v_brand',
        vehicle_image1='$v_image1',vehicle_image2='$v_image2',vehicle_image3='$v_image3',vehicle_price='$v_rate',date=NOW() WHERE vehicle-id = $get_edit_id";
        $result_edit = mysqli_query($con, $edit);
        if ($result_edit) {
            echo "<script>alert('Update successful')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        }
    }
}

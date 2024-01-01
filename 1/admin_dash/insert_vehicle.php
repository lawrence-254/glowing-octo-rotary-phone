<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/connect.php');
if (isset($_POST['insert_vehicle'])) {
    $vehicle_title = $_POST['vehicle_title'];
    $description = $_POST['description'];
    $plate_no = $_POST['plate_no'];
    $category_title = $_POST['category_title'];
    $brand_title = $_POST['brand_title'];
    $price = $_POST['price'];
    $vehicle_status = 'true';

    // images
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];

    // image temporary name
    $tmp_image1 = $_FILES['image1']['tmp_name'];
    $tmp_image2 = $_FILES['image2']['tmp_name'];
    $tmp_image3 = $_FILES['image3']['tmp_name'];

    // confirm all are filled
    if (
        $vehicle_title == '' || $description == '' || $plate_no == '' ||
        $category_title == '' || $brand_title == '' || $price == '' ||
        $image1 == '' || $image2 == '' || $image3 == ''
    ) {
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    } else {
        $target_dir = "./vehicle_images/";

        // Move uploaded files to target directory
        move_uploaded_file($tmp_image1, $target_dir . $image1);
        move_uploaded_file($tmp_image2, $target_dir . $image2);
        move_uploaded_file($tmp_image3, $target_dir . $image3);

        // Insert query
        $insert_vehicles = "INSERT INTO `vehicles` (vehicle_title, vehicle_description, vehicle_reg, category_id, brand_id, vehicle_image1, vehicle_image2, vehicle_image3, vehicle_price, date, vehicle_status)
        VALUES ('$vehicle_title', '$description', '$plate_no', '$category_title', '$brand_title', '$image1', '$image2', '$image3', '$price', NOW(), '$vehicle_status')";

        $result_query = mysqli_query($con, $insert_vehicles);
        if ($result_query) {
            echo "<script>alert('Vehicle inserted successfully')</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert vehicle | Admin Dashboard</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Vehicle</h1>
        <!-- insert form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="vehicle_title" class="form-label">Vehicle Title</label>
                <input type="text" name="vehicle_title" id="vehicle_title" class="form-control" placeholder="Enter title..." autocomplete="off" required="required">
            </div>
            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Add a description..." autocomplete="off" required="required">
            </div>
            <!-- Registration -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="plate_no" class="form-label">Number plate</label>
                <input type="text" name="plate_no" id="plate_no" class="form-control" placeholder="Enter registration" autocomplete="off" required="required">
            </div>
            <!-- category -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="category_title" id="" class="form-control">
                    <option value="">Select a category</option>
                    <?php
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                    $select_query = "SELECT * FROM `category`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>


                </select>
            </div>
            <!-- brand -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="brand_title" id="" class="form-control">
                    <option value="">Select a brand</option>
                    <?php
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                    $select_query = "SELECT * FROM `brand`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>


                </select>
            </div>
            <!-- images -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="image1">Image 1</label>
                <input type="file" name="image1" id="image1" class="form-control">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="image2">Image 2</label>
                <input type="file" name="image2" id="image2" class="form-control">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="image3">Image 3</label>
                <input type="file" name="image3" id="image3" class="form-control">
            </div>
            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="Price" class="form-label">Price</label>
                <input type="text" name="price" id="price" class="form-control" placeholder="Enter cost..." autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_vehicle" class="btn btn-info" value="Insert vehicle">
            </div>
        </form>
        <div class="form-outline mb-4 w-50 m-auto">
            <a href="index.php" class="btn btn-warning">back to dashboard</a>
        </div>
    </div>

</body>

</html>
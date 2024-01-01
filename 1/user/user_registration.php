<!DOCTYPE html>
<?php
include('../functions/shared_func.php');
include('../includes/connect.php');
include('../includes/header.php');

?>
<title>customer signup</title>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center">Customer Sign Up</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- username -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">User Name</label>
                        <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" />
                    </div>
                    <!-- email -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">User Email</label>
                        <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" />
                    </div>
                    <!-- image -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" name="user_image" id="user_image" class="form-control" />
                    </div>
                    <!-- password -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">User Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" />
                    </div>
                    <!-- password confirm -->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" name="conf_user_password" id="conf_user_password" class="form-control" placeholder="Confirm your password" autocomplete="off" required="required" />
                    </div>
                    <!-- address -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">User Address</label>
                        <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" />
                    </div>
                    <!-- contacts -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">User Contact</label>
                        <input type="text" name="user_contact" id="user_contact" class="form-control" placeholder="Enter your contacts" autocomplete="off" required="required" />
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="SignUp" class="btn btn-success py-2 px-3" name="user_register">
                        <p class="fw-bold mt-2 pt-1">Already have an account? <a href="user_login.php" class="text-danger"><span>Login</span></a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<!-- php validation -->
<?php
if (isset($_POST['user_register'])) {
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_password = $_POST['user_password'];
    $user_username = $_POST['user_username'];
    $conf_user_password = $_POST['conf_user_password'];
    $user_ip = getIPAddress();

    // hash password
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // image
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp, "./user_image/$user_image");
    if ($_FILES['user_image']['error'] !== UPLOAD_ERR_OK) {
        die('File upload failed with error code: ' . $_FILES['user_image']['error']);
    }


    // select
    $select_query = "SELECT * FROM `customer_table` WHERE user_name = '$user_username' OR user_email = '$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('Username or email already exists, please choose another name or email')</script>";
    } else if ($user_password != $conf_user_password) {
        echo "<script>alert('Passwords do not match, please try again')</script>";
    } else {
        // insert into db
        $insert_query = "INSERT INTO `customer_table` (user_name, user_email, user_password, user_image, user_ip_address, user_address, user_mobile)
                        VALUES ('$user_username', '$user_email', '$hashed_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";

        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
    $select_booking_info = "select * from `bookings` where ip_address = '$user_ip'";
    $bookings_result = mysqli_query($con, $select_booking_info);
    $rows_count = mysqli_num_rows($bookings_result);
    if ($rows_count > 0) {
        $_SESSION['user_username'] = $user_username;
        echo "<script>alert('You have pending bookings')</script>";
        echo "<script>window.open('pay.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
?>
<!DOCTYPE html>
<?php
include('../functions/shared_func.php');
include('../includes/connect.php');
include('../includes/header.php');
session_start();
?>
<title>customer login</title>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center">Customer Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">
                    <!-- username -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">User Name</label>
                        <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" />
                    </div>

                    <!-- password -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">User Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" />
                    </div>

                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="btn btn-success py-2 px-3" name="user_login">
                        <p class="fw-bold mt-2 pt-1">Don't have an account? <a href="user_registration.php" class="text-danger"><span>SignUp</span></a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_ip = getIPAddress();

    $select_query = "SELECT * FROM `customer_table` WHERE user_name = '$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    // bookings
    $select_bookings_query = "SELECT * FROM `bookings` WHERE ip_address = '$user_ip'";
    $bookings_result = mysqli_query($con, $select_bookings_query);
    $bookings_row_count = mysqli_num_rows($bookings_result);

    if ($row_count > 0) {
        if (password_verify($user_password, $row_data['user_password'])) {
            if ($row_count == 1 && $bookings_row_count == 0) {
                $_SESSION['user_username'] = $user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                $_SESSION['user_username'] = $user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid password')</script>";
        }
    } else {
        echo "<script>alert('User does not exist, please check your credentials or register')</script>";
    }
}
?>
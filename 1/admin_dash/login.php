<!DOCTYPE html>
<?php
include('../functions/shared_func.php');
include('../includes/connect.php');
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css -->
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            overflow: hidden;
        }
    </style>
    <title>Admin Login
    </title>
</head>
<body>
<div class="container-fluid m-6">
    <h2 class="text-center mb-5">Login Admin</h2>
    <div class="row justify-content-center align-items-center w-80">
        <form action="" method="post">
            <div class="form-outline mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" placeholder="enter username" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" placeholder="enter password" class="form-control" required="required">
            </div>
            <div class="">
                <input class="btn btn-success mb-4" type="submit" name="admin_login" value="LOGIN">
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php
if (isset($_POST['admin_login'])) {
    $admin_username = $_POST['username'];
    $admin_password = $_POST['password'];

    $select_query = "SELECT * FROM `admin` WHERE admin_name = '$admin_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    // bookings
    $select_bookings_query = "SELECT * FROM `bookings` WHERE ip_address = '$user_ip'";
    $bookings_result = mysqli_query($con, $select_bookings_query);
    $bookings_row_count = mysqli_num_rows($bookings_result);

    if ($row_count > 0) {
        if (password_verify($admin_password, $row_data['password'])) {
                $_SESSION['admin_name'] = $admin_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('index.php','_self')</script>";

        } else {
            echo "<script>alert('Invalid password')</script>";
        }
    } else {
        echo "<script>alert('User does not exist, please check your credentials or register')</script>";
    }
}
?>
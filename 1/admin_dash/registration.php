<?php
include('../functions/shared_func.php');
include('../includes/connect.php');
?>
<!DOCTYPE html>
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
    <title>Admin Registration
    </title>
</head>
<body>
<div class="container-fluid m-6">
    <h2 class="text-center mb-5">Register Admin</h2>
    <div class="row justify-content-center align-items-center w-80">
        <form action="" method="post">
            <div class="form-outline mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" placeholder="enter username" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" placeholder="enter email" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" placeholder="enter password" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" class="form-control" required="required">
            </div>
            <div class="">
                <input class="btn btn-success mb-4" type="submit" name="admin_register" value="REGISTER">
                <p class="small">Have an account?
                    <a href="login.php" class="link-info fw-bold">LOGIN</a>
                </p>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<!-- php validation -->
<?php
if (isset($_POST['admin_register'])) {
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];
    $admin_username = $_POST['username'];
    $conf_admin_password = $_POST['confirm_password'];


    // hash password
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);


    // select
    $select_query = "SELECT * FROM `admin` WHERE admin_name = '$admin_username' OR admin_email = '$admin_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('Username or email already exists, please choose another name or email')</script>";
    } else if ($admin_password != $conf_admin_password) {
        echo "<script>alert('Passwords do not match, please try again')</script>";
    } else {
        // insert into db
        $insert_query = "INSERT INTO `admin` (admin_name, admin_email, password)
                        VALUES ('$admin_username', '$admin_email', '$hashed_password')";

        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            die(mysqli_error($con));
        }
    }

}
?>
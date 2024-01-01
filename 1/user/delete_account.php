<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>

<body>
    <h1 class="text-danger my-5">DELETE ACCOUNT???</h1>
    <form action="" method="post">
        <div class="form-outline w-50 m-auto mb-5">
            <input type="submit" value="Delete Account" class="form-control bg-danger text-warning" name="delete">
        </div>
    </form>
    <a href=></a>

</body>

</html>
<?php
$user_session = $_SESSION['user_username'];

if (isset($_POST['delete'])) {
    $delete_query = "DELETE FROM `customer_table` WHERE user_name = '$user_session'";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        session_destroy();
        echo "<script>alert('Your account has been deleted successfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    } else {
        echo "Error deleting account: " . mysqli_error($con);
    }
}

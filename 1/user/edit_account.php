<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['user_username'];
    $select_query = "SELECT * FROM `customer_table` WHERE user_name='$user_session_name'";
    $result_query = mysqli_query($con, $select_query);

    if ($result_query) {
        $row_fetch = mysqli_fetch_assoc($result_query);
        $user_id = $row_fetch['user_id'];
        $user_name = $row_fetch['user_name'];
        $user_email = $row_fetch['user_email'];
        $user_address = $row_fetch['user_address'];
        $user_mobile = $row_fetch['user_mobile'];

        if (isset($_POST['update_info'])) {
            $update_id = $user_id;
            $user_name = $_POST['user_name'];
            $user_email = $_POST['user_email'];
            $user_address = $_POST['user_address'];
            $user_mobile = $_POST['user_mobile'];
            $user_image = $_FILES['user_image']['name'];
            $user_image_tmp = $_FILES['user_image']['tmp_name'];
            move_uploaded_file($user_image_tmp, "./user_images/$user_image");

            // Update query
            $update_query = "UPDATE `customer_table` SET user_name='$user_name', user_email='$user_email', user_image='$user_image', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
            $result_query_update = mysqli_query($con, $update_query);

            if ($result_query_update) {
                echo "<script>alert('Update successful')</script>";
                // echo "<script>window.open('logout.php''_self')</script>";
            } else {
                echo "Error updating user information: " . mysqli_error($con);
            }
        }
    } else {
        echo "Error fetching user information: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        .edit_img {
            width: 150px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <h3 class="text-center text-warning mb-4">Edit My Account Details</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" name="user_username" placeholder="Enter your username..." value="<?php echo $user_name ?>" class="form-control m-auto w-50">
        </div>
        <div class="form-outline mb-4">
            <input type="email" placeholder="Enter your email..." name=" user_email" value="<?php echo $user_email ?>" class="form-control m-auto w-50">
        </div>
        <div class="form-outline mb-4">
            <input type="text" name="user_address" placeholder="Enter your address..." value="<?php echo $user_address ?>" class="form-control m-auto w-50">
        </div>
        <div class="form-outline mb-4 m-auto w-50 d-flex">
            <input type="file" name="user_image" class="form-control  m-auto w-50">
            <img src='./user_images/<?php echo $user_image ?>' class='edit_img'>
        </div>
        <div class="form-outline mb-4">
            <input type="text" name="user_mobile" placeholder="Enter your mobile number..." value="<?php echo $user_mobile ?>" class="form-control m-auto w-50">
        </div>

        <input type="submit" name="update_info" value="Update Your Details" class="form-control m-auto w-50 bg-warning">

    </form>

</body>

</html>
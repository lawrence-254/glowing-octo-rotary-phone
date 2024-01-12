<!DOCTYPE html>
<?php
include('../functions/shared_func.php');
include('../includes/connect.php');
include('../includes/header.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// session_start();
?>
<title>Payment</title>
</head>

<body>
    <!-- access user -->
    <?php
    $user_ip = getIPAddress();
    $get_user = "SELECT * FROM `customer_table` WHERE user_ip_address = '$user_ip'";
    $result = mysqli_query($con, $get_user);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_id'];
    ?>

    <div class="container vh-100 w-auto">
        <h2 class="text-center text-info ">Payment Options</h2>
        <div class="row d-flex justify-content-center align-item-center m-5">
            <div class="col-md-4">
                <a href="order.php?user_id=<?php echo $user_id ?>">
                    <h2 class="text-center">CASH</h2>
                </a>
            </div>

        </div>

    </div>
            <a href="../index.php" class="btn btn-info bottom-0">home</a>
</body>

</html>
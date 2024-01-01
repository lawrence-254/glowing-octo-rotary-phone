<!DOCTYPE html>
<?php
include('../functions/shared_func.php');
include('../includes/connect.php');
include('../includes/header.php');
session_start();
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

    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-item-center m-5">
            <div class="col-md-6">
                <a href="#">
                    <h2 class="text-center">E-PAYMENT</h2>
                </a>
            </div>
            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>">
                    <h2 class="text-center">CASH</h2>
                </a>
            </div>

        </div>
    </div>
</body>

</html>
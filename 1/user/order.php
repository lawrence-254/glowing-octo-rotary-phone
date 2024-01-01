<?php
include('includes/connect.php');
include('functions/shared_func.php');
include('includes/header.php');

session_start();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

// Getting cost
$user_ip = getIPAddress();
$cost = 0;

$booking_price_query = "SELECT * FROM `bookings` WHERE ip_address = '$user_ip'";
$result = mysqli_query($con, $booking_price_query);
$order_number = mt_rand();
echo "Order Number: " . $order_number . "<br>";
$status = 'pending';

if ($result) {
    while ($row_price = mysqli_fetch_assoc($result)) {
        $v_id = $row_price['vehicle_id'];
        $vehicle_query = "SELECT * FROM `vehicles` WHERE vehicle_id = $v_id";
        $run_query = mysqli_query($con, $vehicle_query);

        if ($run_query) {
            while ($row_v_price = mysqli_fetch_assoc($run_query)) {
                $v_price = $row_v_price['vehicle_price'];
                $cost += $v_price;
            }
        } else {
            // Handle query error
            echo "Error in vehicle query: " . mysqli_error($con);
        }
    }
} else {
    // Handle query error
    echo "Error in booking query: " . mysqli_error($con);
}



// Output the total cost
echo "Total Cost: " . $cost;

// Clean up resources
mysqli_free_result($result);

//getting days from bookings
$days_in_booking = "SELECT * FROM `bookings`";
$run_day_result = mysqli_query($con, $days_in_booking);
$get_days = mysqli_fetch_assoc($run_day_result);
$days = $get_days['days'];

if ($days) {
    $subtotal = $cost * $days;
}

$insert_order = "INSERT INTO `order` (user_id, cost, order_number, order_size, order_date, order_status) VALUES ($user_id, $subtotal, $order_number, $days, NOW(), '$status')";
$insert_result = mysqli_query($con, $insert_order);

if ($insert_result) {
    echo "<script>alert('Order submitted')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
} else {
    // Handle query error
    echo "Error in inserting order: " . mysqli_error($con);
}

//pending approval orders
$pending_insert_order = "INSERT INTO `pending_order` (user_id, order_number, v_id, order_size, order_status) VALUES ($user_id, $order_number, $v_id, $days, '$status')";
$insert_pending_result = mysqli_query($con, $pending_insert_order);

//empty bookings
$empty_bookings = "DELETE FROM `bookings` WHERE ip_address='$user_ip'";
$delete_result = mysqli_query($con, $empty_bookings);

if ($delete_result) {
    echo "Successfully deleted bookings for IP address: $user_ip";
} else {
    echo "Error deleting bookings: " . mysqli_error($con);
}

// Clean up resources
mysqli_close($con);
?>


<title>Document</title>
</head>

<body>

</body>

</html>
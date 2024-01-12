<?php
session_start();
include('../includes/connect.php');
include('../functions/shared_func.php');
include('../includes/header.php');


if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

} else {
    // Handle the case where user_id is not set
    echo "user_id is not set.";
    $user_id = 404;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Getting cost
$user_ip = getIPAddress();
$cost = 0;




$booking_price_query = "SELECT * FROM `bookings` WHERE ip_address = '$user_ip'";
$result = mysqli_query($con, $booking_price_query);
// $count_res = mysqli_num_rows($result);


$order_number = mt_rand();
echo "Order Number: " . $order_number . "<br>";
$status = 'pending';
echo "Status: " . $status . "<br>";
echo $user_id;

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

// // Clean up resources
// mysqli_free_result($result);

//getting days from bookings
$booking_details = "SELECT * FROM `bookings`";
$run_day_result = mysqli_query($con, $booking_details);
$subtotal =0;

if (!$run_day_result) {
    // Handle query error
    echo "Error in booking details query: " . mysqli_error($con);
} else {
    $get_days = mysqli_fetch_assoc($run_day_result);

    if ($get_days) {
        $days = $get_days['days'];

        if ($days === null || $days === '') {
            // Handle case where 'days' is null or empty
            $days = 1;
            $subtotal = $cost;
        } else {
            $days = intval($days); // Ensure it's an integer
            $subtotal = $cost * $days;
        }
        // Use prepared statement for the INSERT query
        $insert_order = "INSERT INTO `order` (`user_id`, `cost`, `order_number`, `order_size`, `order_date`, `order_status`) VALUES (?, ?, ?, ?, NOW(), ?)";
        $stmt = mysqli_prepare($con, $insert_order);
        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "idids", $user_id, $subtotal, $order_number, $days, $status);
            // Execute statement
            $insert_result = mysqli_stmt_execute($stmt);
            // Check for success
            if ($insert_result) {
                // Success
                echo "<script>alert('Success')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                // Handle error
                echo "Error in inserting order: " . mysqli_error($con);
            }
                // Close statement
                mysqli_stmt_close($stmt);
        } else {
            // Handle statement preparation error
            echo "Error in preparing statement: " . mysqli_error($con);
        }
        //pending
        $pending_insert_order = "INSERT INTO `pending_order` (`user_id`, `order_number`, `v_id`, `order_size`, `order_status`) VALUES (?, ?, ?, ?, ?)";
        // Assuming $con is your database connection
        $stmt_pending_order = mysqli_prepare($con, $pending_insert_order);
        if ($stmt_pending_order) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt_pending_order, "iiids", $user_id, $order_number, $v_id, $days, $status);
            // Execute statement
            $insert_pending_result = mysqli_stmt_execute($stmt_pending_order);
            // Check for success
            if ($insert_pending_result) {
                // Success
                echo "<script>alert('Pending order successfully inserted')</script>";
            } else {
                // Handle error
                echo "Error in inserting pending order: " . mysqli_error($con);
            }

            // Close statement
            mysqli_stmt_close($stmt_pending_order);
        } else {
            // Handle statement preparation error
            echo "Error in preparing pending order statement: " . mysqli_error($con);
        }
        // Empty bookings
        $empty_bookings_query = "DELETE FROM `bookings` WHERE ip_address = ?";
        $stmt_empty_bookings = mysqli_prepare($con, $empty_bookings_query);
        if ($stmt_empty_bookings) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt_empty_bookings, "s", $user_ip);
            // Execute statement
            $delete_result = mysqli_stmt_execute($stmt_empty_bookings);
            if ($delete_result) {
                echo "Successfully deleted bookings for IP address: $user_ip";
            } else {
                echo "Error deleting bookings: " . mysqli_error($con);
            }
            // Close statement
            mysqli_stmt_close($stmt_empty_bookings);
        } else {
            echo "Error preparing delete statement: " . mysqli_error($con);
        }
    } else {
        // Handle case where no rows were returned
        echo "No booking details found.";
    }
}






// //pending approval orders
// $pending_insert_order = "INSERT INTO `pending_order` (`user_id`, order_number, v_id, order_size, order_status) VALUES ($user_id, $order_number, $v_id, $days, '$status')";
// $insert_pending_result = mysqli_query($con, $pending_insert_order);


?>

<!--
// <title>Document</title>
// </head>

// <body>
// s
// </body>

// </html> -->
<?php

// Check if the user is logged in
if (isset($_SESSION['user_username'])) {
    // Retrieve the username from the session
    $username = $_SESSION['user_username'];

    // Prepare the query
    $get_customer = "SELECT * FROM `customer_table` WHERE user_name = '$username'";

    // Execute the query
    $result_query = mysqli_query($con, $get_customer);

    // Check if the query was successful
    if ($result_query) {
        // Fetch the row as an associative array
        $row_fetch = mysqli_fetch_assoc($result_query);

        // Check if a row was found
        if ($row_fetch) {
            // Retrieve the user ID
            $user_id = $row_fetch['user_id'];

            // Output the user ID
            echo $user_id;
        } else {
            echo "User not found in the database.";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($con);
    }
} else {
    echo "User is not logged in.";
}
?>

<h3 class="text-info">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead>
        <tr>
            <th>no.</th>
            <th>Cost</th>
            <th>Duration(days)</th>
            <th>Order no.</th>
            <th>Date</th>
            <th>Completion</th>
            <th>pay</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get_order_details = "SELECT * FROM `order` WHERE user_id = '$user_id'";
        $result_order = mysqli_query($con, $get_order_details);

        if ($result_order) {
            $sn = 1;
            while ($row_data = mysqli_fetch_assoc($result_order)) {
                $o_id = $row_data['order_id'];
                $o_cost = $row_data['cost'];
                $o_duration = $row_data['order_size'];
                $o_no = $row_data['order_number'];
                $o_date = $row_data['order_date'];
                $o_status = $row_data['order_status'];

                echo "<tr>
            <td>$sn</td>
            <td>$o_cost</td>
            <td>$o_duration</td>
            <td>$o_no</td>
            <td>$o_date</td>
            <td>$o_status</td>";

                if ($o_status == 'complete') {
                    echo "<td>Paid</td>";
                } else {
                    echo "<td>
                <a href='confirm_payment.php?order_id=$o_id' class='text-center text-success'>
                    Confirm payment
                </a>
            </td>";
                }

                echo "</tr>";

                $sn++;
            }
        } else {
            echo "Error fetching order details: " . mysqli_error($con);
        }
        ?>
    </tbody>
</table>
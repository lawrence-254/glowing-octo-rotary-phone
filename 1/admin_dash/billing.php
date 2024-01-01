<h3 class="text-center text-success">BILLING INFO</h3>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assuming $con is your database connection

$get_payment = "SELECT * FROM `payments`";
$result = mysqli_query($con, $get_payment);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    echo "<h2 class='text-danger text-center mt-5'>NO BOOKING ORDERS AT THE MOMENT!!</h2>";
} else {
    echo "<table class='table table-bordered mt-5'>
            <thead class='bg-info'>
                <tr>
                    <th class='text-center bg-info text-dark'>No.</th>
                    <th class='text-center bg-info text-dark'>order no.</th>
                    <th class='text-center bg-info text-dark'>Amount</th>
                    <th class='text-center bg-info text-dark'>Mode of payment</th>
                    <th class='text-center bg-info text-dark'>Date booked</th>
                    <th class='text-center bg-info text-dark'>delete</th>
                </tr>
            </thead>
            <tbody>";

    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $order_no = $row_data['order_no'];
        $amount = $row_data['amount'];
        $payment_method = $row_data['payment_method'];
        $date = $row_data['date'];
        $status = $row_data['order_status'];
        $u_id = $row_data['user_id'];
        $o_id = $row_data['order_id'];
        $number++;

        echo "<tr>
                <td class='text-center bg-light text-dark'>$number</td>
                <td class='text-center bg-light text-dark'>$order_no</td>
                <td class='text-center bg-light text-dark'>$amount</td>
                <td class='text-center bg-light text-dark'>$payment_method</td>
                <td class='text-center bg-light text-dark'>$date</td>
                <td><a href='delete.php?id=$o_id' class='text-secondary' onclick='return confirm(\"Are you sure you want to delete this entry?\")'><i class='fa-solid fa-trash'></i></a></td>
            </tr>";
    }

    echo "</tbody>
        </table>";
}
?>


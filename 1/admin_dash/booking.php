<h3 class="text-center text-success">BOOKINGS</h3>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$get_booking = "SELECT * FROM `order`";
$result = mysqli_query($con, $get_booking);
$row_count = mysqli_num_rows($result);
if ($row_count == 0) {
    echo "<h2 class='text-danger text-center mt-5'>NO BOOKING ORDERS AT THE MOMENT!!</h2>";
}  else {
    echo "<table class='table table-bordered mt-5'>
    <thead class='bg-info'>
    <tr>
    <th class='text-center bg-info text-dark'>no.</th>
    <th class='text-center bg-info text-dark'>B. cost</th>
    <th class='text-center bg-info text-dark'>B. number</th>
    <th class='text-center bg-info text-dark'>days</th>
    <th class='text-center bg-info text-dark'>B. date</th>
    <th class='text-center bg-info text-dark'>status</th>
    <th class='text-center bg-info text-dark'>delete</th>
    </tr>
    </thead>
    <tbody>";
    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $b_no = $row_data['order_number'];
        $b_cost = $row_data['cost'];
        $days = $row_data['order_size'];
        $date = $row_data['order_date'];
        $status = $row_data['order_status'];
        $u_id = $row_data['user_id'];
        $o_id = $row_data['order_id'];
        $number++;
        echo "<tr>
        <td class='text-center bg-light text-dark'>$number</td>
        <td class='text-center bg-light text-dark'>$b_cost</td>
        <td class='text-center bg-light text-dark'>$b_no</td>
        <td class='text-center bg-light text-dark'>$days</td>
        <td class='text-center bg-light text-dark'>$date</td>
        <td class='text-center bg-light text-dark'>$status</td>
        <td><a href='delete.php?id=$o_id' class='text-secondary' onclick='return confirm(\"Are you sure you want to delete this entry?\")'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
    }
    echo "</tbody>
    </table>";
}
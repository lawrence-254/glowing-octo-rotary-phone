<h3 class="text-center text-success">REGISTERED CUSTOMERS</h3>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assuming $con is your database connection

$get_customers = "SELECT * FROM `customer_table`";
$result = mysqli_query($con, $get_customers);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    echo "<h2 class='text-danger text-center mt-5'>NO REGISTERED CUSTOMERS AT THE MOMENT!!</h2>";
} else {
    echo "<table class='table table-bordered mt-5'>
            <thead class='bg-info'>
                <tr>
                    <th class='text-center bg-info text-dark'>No.</th>
                    <th class='text-center bg-info text-dark'>use image</th>
                    <th class='text-center bg-info text-dark'>User name</th>
                    <th class='text-center bg-info text-dark'>Email</th>
                    <th class='text-center bg-info text-dark'>Address</th>
                    <th class='text-center bg-info text-dark'>contacts</th>
                    <th class='text-center bg-info text-dark'>delete</th>
                </tr>
            </thead>
            <tbody>";

    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $user_name = $row_data['user_name'];
        $user_email = $row_data['user_email'];
        $user_image = $row_data['user_image'];
        $user_address = $row_data['user_address'];
        $user_mobile= $row_data['user_mobile'];
        $u_id = $row_data['user_id'];
        $o_id = $row_data['order_id'];
        $number++;

        echo "<tr>
                <td class='text-center bg-light text-dark'>$number</td>
                <td class='text-center bg-light text-dark'><img src='./user/user_images/$user_name' alt='$user_name'></img></td>
                <td class='text-center bg-light text-dark'>$user_name</td>
                <td class='text-center bg-light text-dark'>$user_email</td>
                <td class='text-center bg-light text-dark'>$user_address</td>
                <td class='text-center bg-light text-dark'>$user_mobile</td>
                <td><a href='delete.php?id=$o_id' class='text-secondary' onclick='return confirm(\"Are you sure you want to delete this entry?\")'><i class='fa-solid fa-trash'></i></a></td>
            </tr>";
    }

    echo "</tbody>
        </table>";
}
?>
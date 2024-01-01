<h1 class="text-center text-success bg-info">All Vehicles</h1>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">
        <tr class="bg-info">
            <th class="bg-info">Vehicle ID</th>
            <th class="bg-info">Vehicle Title</th>
            <th class="bg-info">Vehicle Image</th>
            <th class="bg-info">rate/day</th>
            <th class="bg-info">Registration</th>
            <th class="bg-info">Availability</th>
            <th class="bg-info">Edit</th>
            <th class="bg-info">Delete</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        try {
            $get_vehicles = "SELECT * FROM vehicles  ORDER BY `vehicle_description` ASC";
            $stmt = mysqli_prepare($con, $get_vehicles);
            if (!$stmt) {
                throw new Exception("Error in preparing the SQL query: " . mysqli_error($con));
            }

            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing the SQL query: " . mysqli_error($con));
            }

            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $v_id = $row['vehicle_id'];
                $v_title = $row['vehicle_title'];
                $v_image1 = $row['vehicle_image1'];
                $v_rate = $row['vehicle_price'];
                $v_reg = $row['vehicle_reg'];
                $v_status = $row['vehicle_status'];
                echo "<tr>
                    <td>$v_id</td>
                    <td>$v_title</td>
                    <td><img src='./vehicle_images/$v_image1' class='v_img'/></td>
                    <td>$v_rate</td>
                    <td>$v_reg</td>
                    <td>$v_status</td>
                    <td><a href='index.php?edit=$v_id' class='text-secondary'><i class='fa-solid fa-pen-to-square'></i></td>
                    <td><a href='index.php?delete=$v_id'class='text-secondary'><i class='fa-solid fa-trash'></i></td>
                </tr>";
            }

            mysqli_free_result($result);
            mysqli_stmt_close($stmt);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

        <tr>
            <td>id</td>
            <td>title</td>
            <td>image</td>
            <td>rate</td>
            <td>plate</td>
            <td>status</td>
            <td><a href="" class="text-secondary"><i class="fa-solid fa-pen-to-square"></i></td>
            <td><a href="" class="text-secondary"><i class="fa-solid fa-trash"></i></td>
        </tr>
    </tbody>
</table>
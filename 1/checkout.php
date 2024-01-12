<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/connect.php');
include('functions/shared_func.php');
include('includes/header.php');
session_start();

?>

<title>Msafiri | BOOKINGS</title>
<style>
    .thumbnail {
        max-width: 150px;
        height: auto;
    }
</style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><i class="fa fa-road" aria-hidden="true"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="fleet.php">Fleet</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>Account
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                error_reporting(E_ALL);
                                ini_set('display_errors', 1);
                                if (!isset($_SESSION['user_name'])) {
                                    echo '<li><a class="dropdown-item" href="user/user_login.php">Login</a></li>';
                                    echo '<li><a class="dropdown-item" href="user/user_registration.php">Register</a></li>';
                                } else {
                                    echo '<li><a class="dropdown-item" href="user/user_logout.php">Logout</a></li>';
                                }
                                ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Admin Login</a></li>
                            </ul>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </div>
    <!-- booking -->
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    book();
    ?>
    <!-- hero -->
    <div class=" bg-light">
        <h3 class="text-center">Lorem ipsum dolor sit amet.</h3>
        <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, perferendis! Debitis, a quod. Laborum fuga laudantium quisquam, asperiores ea quam illum nam sed minima maxime!</p>
    </div>
    <!-- booking checkout -->
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Duration(days)</th>
                            <th>Total cost(/day)</th>
                            <th colspan="2">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- dynamic by php -->
                        <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        global $con;
                        $total_price = 0;
                        $get_ip_address = getIPAddress();
                        $pricing_query = "SELECT * FROM `bookings` WHERE ip_address='$get_ip_address'";
                        $pricing_result = mysqli_query($con, $pricing_query);

                        while ($row = mysqli_fetch_array($pricing_result)) {
                            $bt_vehicle_id = $row['vehicle_id'];
                            $select_vehicle = "SELECT * FROM `vehicles` WHERE vehicle_id = '$bt_vehicle_id'";
                            $vehicle_result = mysqli_query($con, $select_vehicle);

                            while ($row_vehicle_price = mysqli_fetch_array($vehicle_result)) {
                                $vehicle_price_result = $row_vehicle_price['vehicle_price'];
                                $v_price = $row_vehicle_price['vehicle_price'];
                                $v_title = $row_vehicle_price['vehicle_title'];
                                $v_image = $row_vehicle_price['vehicle_image1'];
                                $total_price += $vehicle_price_result;
                        ?>

                                <tr>
                                    <td class="text-center"><?php echo $v_title ?></td>
                                    <td class="text-center"><img src="./admin_dash/vehicle_images/<?php echo $v_image ?>" alt="" class="thumbnail" /></td>
                                    <td class="text-center"><input type="text" name="duration" id="duration" class="text-center" value="1"></td>
                                    <?php
                                    error_reporting(E_ALL);
                                    ini_set('display_errors', 1);
                                    $get_ip_address = getIPAddress();

                                    if (isset($_POST['update'])) {
                                        $multiplier = $_POST['duration'];
                                        $update_booking = "UPDATE `bookings` SET days = $multiplier WHERE ip_address = '$get_ip_address'";
                                        $weighed_update = mysqli_query($con, $update_booking);
                                        $total_price = $total_price * $multiplier;
                                    }
                                    ?>
                                    <td class="text-center"><?php echo $total_price ?></td>
                                    <td class="text-center">
                                        <input type="submit" value="Update" class="btn btn-success" name="update">
                                        <form action="" method="post">
                                            <input type="hidden" name="vehicle_id[]" value="<?php echo $bt_vehicle_id; ?>">
                                            <input type="submit" value="Remove" class="btn btn-danger" name="remove">
                                        </form>
                                    </td>
                                </tr>

                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </form>

            <!-- total -->
            <div class="mb-5">
                <h2 class="px-3">Subtotal: <strong class="text-success"><?php echo $total_price ?>/=</strong></h2>
                <a href="index.php" class="btn btn-info p-3 b-0">View More</a>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                global $con;
                $get_ip_address = getIPAddress();
                $res_query = "SELECT COUNT(*) AS count FROM `bookings` WHERE ip_address='$get_ip_address'";
                $return_query = mysqli_query($con, $res_query);
                $row = mysqli_fetch_assoc($return_query);
                $res_count = $row['count'];

                if ($res_count > 0) {
                    echo '<a href="./user/pay.php" class="btn btn-success p-3 b-0">Checkout</a>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    function remove_vehicle()
    {
        global $con;
        $get_ip_address = getIPAddress();

        if (isset($_POST['remove'])) {
            $vehicle_ids = $_POST['vehicle_id'];
            if (!empty($vehicle_ids)) {
                foreach ($vehicle_ids as $vehicle_id) {
                    $delete_booking = "DELETE FROM `bookings` WHERE ip_address = '$get_ip_address' AND vehicle_id = '$vehicle_id'";
                    $delete_result = mysqli_query($con, $delete_booking);

                    if ($delete_result) {
                        echo "<script>window.open('checkout.php', '_self')</script>";
                    } else {
                        echo "Error occurred while removing the vehicle.";
                    }
                }
            }
        }
    }

    remove_vehicle();
    ?>

    <?php
    include('includes/footer.php');

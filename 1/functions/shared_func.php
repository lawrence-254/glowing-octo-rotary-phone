<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// include('../includes/connect.php');
// getting products
function get_vehicles()
{
    global $con;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {

            $select_query = "SELECT * FROM `vehicles` order by rand() limit 0,6";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $vehicle_title = $row['vehicle_title'];
                $vehicle_id = $row['vehicle_id'];
                $vehicle_description = $row['vehicle_description'];
                $vehicle_reg = $row['vehicle_reg'];
                $vehicle_image1 = $row['vehicle_image1'];
                $vehicle_image2 = $row['vehicle_image2'];
                $vehicle_image3 = $row['vehicle_image3'];
                $vehicle_price = $row['vehicle_price'];
                $vehicle_status = $row['vehicle_status'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo "  <div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='./admin_dash/vehicle_images/$vehicle_image1' class='card-img-top' alt=$vehicle_title>
                        <div class='card-body'>
                            <h5 class='card-title'>$vehicle_title</h5>
                            <p class='card-text'>$vehicle_description</p>
                            <p><span>Price per day in shillings:</span>$vehicle_price</p>
                            <a href='index.php?add_to_booking=$vehicle_id' class='btn btn-primary'>Pick</a>
                            <a href='vehicle_detail.php?vehicle_id=$vehicle_id' class='btn btn-secondary'>View</a>
                        </div>
                    </div>
                </div>";
            }
        }
    }
}
// get all vehicles
function get_all_vehicles()
{
    global $con;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {

            $select_query = "SELECT * FROM `vehicles` order by rand()";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $vehicle_title = $row['vehicle_title'];
                $vehicle_id = $row['vehicle_id'];
                $vehicle_description = $row['vehicle_description'];
                $vehicle_reg = $row['vehicle_reg'];
                $vehicle_image1 = $row['vehicle_image1'];
                $vehicle_image2 = $row['vehicle_image2'];
                $vehicle_image3 = $row['vehicle_image3'];
                $vehicle_price = $row['vehicle_price'];
                $vehicle_status = $row['vehicle_status'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo "  <div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='./admin_dash/vehicle_images/$vehicle_image1' class='card-img-top' alt=$vehicle_title>
                        <div class='card-body'>
                            <h5 class='card-title'>$vehicle_title</h5>
                            <p class='card-text'>$vehicle_description</p>
                                                        <p><span>Price per day in shillings:</span>$vehicle_price</p>
                            <a href='index.php?add_to_booking=$vehicle_id' class='btn btn-primary'>Pick</a>
                            <a href='vehicle_detail.php?vehicle_id=$vehicle_id' class='btn btn-secondary'>View</a>
                        </div>
                    </div>
                </div>";
            }
        }
    }
}
// getting specified category
function get_specific_cat()
{
    global $con;
    if (isset($_GET['category'])) {
        $cat_id = $_GET['category'];
        $select_query = "SELECT * FROM `vehicles` where category_id=$cat_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo  "<h2 class='text-center text-danger'>Category empty</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $vehicle_title = $row['vehicle_title'];
            $vehicle_id = $row['vehicle_id'];
            $vehicle_description = $row['vehicle_description'];
            $vehicle_reg = $row['vehicle_reg'];
            $vehicle_image1 = $row['vehicle_image1'];
            $vehicle_image2 = $row['vehicle_image2'];
            $vehicle_image3 = $row['vehicle_image3'];
            $vehicle_price = $row['vehicle_price'];
            $vehicle_status = $row['vehicle_status'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            echo "  <div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='./admin_dash/vehicle_images/$vehicle_image1' class='card-img-top' alt=$vehicle_title>
                        <div class='card-body'>
                            <h5 class='card-title'>$vehicle_title</h5>
                            <p class='card-text'>$vehicle_description</p>
                                                        <p><span>Price per day in shillings:</span>$vehicle_price</p>
                            <a href='index.php?add_to_booking=$vehicle_id' class='btn btn-primary'>Pick</a>
                            <a href='vehicle_detail.php?vehicle_id=$vehicle_id' class='btn btn-secondary'>View</a>
                        </div>
                    </div>
                </div>";
        }
    }
}
// getting specific brand
function get_specific_brand()
{
    global $con;
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "SELECT * FROM `vehicles` where brand_id=$brand_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo  "<h2 class='text-center text-danger'>Brand empty</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $vehicle_title = $row['vehicle_title'];
            $vehicle_id = $row['vehicle_id'];
            $vehicle_description = $row['vehicle_description'];
            $vehicle_reg = $row['vehicle_reg'];
            $vehicle_image1 = $row['vehicle_image1'];
            $vehicle_image2 = $row['vehicle_image2'];
            $vehicle_image3 = $row['vehicle_image3'];
            $vehicle_price = $row['vehicle_price'];
            $vehicle_status = $row['vehicle_status'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            echo "  <div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='./admin_dash/vehicle_images/$vehicle_image1' class='card-img-top' alt=$vehicle_title>
                        <div class='card-body'>
                            <h5 class='card-title'>$vehicle_title</h5>
                            <p class='card-text'>$vehicle_description</p>
                                                        <p><span>Price per day in shillings:</span>$vehicle_price</p>
                            <a href='index.php?add_to_booking=$vehicle_id' class='btn btn-primary'>Pick</a>
                            <a href='vehicle_detail.php?vehicle_id=$vehicle_id' class='btn btn-secondary'>View</a>
                        </div>
                    </div>
                </div>";
        }
    }
}

// getting brands
function get_brands()
{
    global $con;
    $select_brand = "SELECT brand_title, brand_id FROM brand";
    $result_brand = mysqli_query($con, $select_brand);

    while ($row_data = mysqli_fetch_assoc($result_brand)) {
        $brand_title = $row_data['brand_title'];
        $brand_id = $row_data['brand_id'];

        echo "<li class='nav-item'>
                    <a href='index.php?brand=" . urlencode($brand_id) . "' class='nav-link'>
                    " . htmlspecialchars($brand_title) . "
                    </a>
                    </li>";
    }
}
// getting category
function get_category()
{
    global $con;
    $select_category = "SELECT category_title, category_id FROM category";
    $result_category = mysqli_query($con, $select_category);

    while ($row_data = mysqli_fetch_assoc($result_category)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];

        echo "<li class='nav-item'>
                    <a href='index.php?category=" . urlencode($category_id) . "' class='nav-link'>
                    " . htmlspecialchars($category_title) . "
                    </a>
                    </li>";
    }
}
// search function

function search_vehicle()
{
    global $con;
    if (isset($_GET['search_data_btn'])) {
        $search_data_value = $_GET['search_data'];
        $search_query =
            "SELECT * FROM `vehicles` WHERE
        vehicle_title LIKE '%$search_data_value%' OR
        vehicle_description LIKE '%$search_data_value%' OR
        category_id LIKE '%$search_data_value%' OR
        brand_id LIKE '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo  "<h2 class='text-center text-danger'>No results for $search_data_value</h2>";
            exit();
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $vehicle_title = $row['vehicle_title'];
            $vehicle_id = $row['vehicle_id'];
            $vehicle_description = $row['vehicle_description'];
            $vehicle_reg = $row['vehicle_reg'];
            $vehicle_image1 = $row['vehicle_image1'];
            $vehicle_image2 = $row['vehicle_image2'];
            $vehicle_image3 = $row['vehicle_image3'];
            $vehicle_price = $row['vehicle_price'];
            $vehicle_status = $row['vehicle_status'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            echo "  <div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='./admin_dash/vehicle_images/$vehicle_image1' class='card-img-top' alt=$vehicle_title>
                        <div class='card-body'>
                            <h5 class='card-title'>$vehicle_title</h5>
                            <p class='card-text'>$vehicle_description</p>
                                                        <p><span>Price per day in shillings:</span>$vehicle_price</p>
                            <a href='index.php?add_to_booking=$vehicle_id' class='btn btn-primary'>Pick</a>
                            <a href='vehicle_detail.php?vehicle_id=$vehicle_id' class='btn btn-secondary'>View</a>
                        </div>
                    </div>
                </div>";
            exit();
        }
    }
}
// view function
function view_details()
{
    global $con;
    if (isset($_GET['vehicle_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $id_vehicle = $_GET['vehicle_id'];
                $select_query = "SELECT * FROM `vehicles` where vehicle_id= $id_vehicle";
                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $vehicle_title = $row['vehicle_title'];
                    $vehicle_id = $row['vehicle_id'];
                    $vehicle_description = $row['vehicle_description'];
                    $vehicle_reg = $row['vehicle_reg'];
                    $vehicle_image1 = $row['vehicle_image1'];
                    $vehicle_image2 = $row['vehicle_image2'];
                    $vehicle_image3 = $row['vehicle_image3'];
                    $vehicle_price = $row['vehicle_price'];
                    $vehicle_status = $row['vehicle_status'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    echo "  <div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='./admin_dash/vehicle_images/$vehicle_image1' class='card-img-top' alt=$vehicle_title>
                        <div class='card-body'>
                            <h5 class='card-title'>$vehicle_title</h5>
                            <p class='card-text'>$vehicle_description</p>
                                                        <p><span>Price per day in shillings:</span>$vehicle_price</p>
                            <a href='index.php?add_to_booking=$vehicle_id' class='btn btn-primary'>Pick</a>
                            <a href='index.php' class='btn btn-secondary'>Home</a>
                        </div>
                    </div>
                </div>
                <div class='col-md-8'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <h4 class='text-center text-info mb-5'>pictures</h4>
                        </div>
                        <div class='col-md-6'>
                            <img src='./admin_dash/vehicle_images/$vehicle_image2' class='card-img-top' alt=$vehicle_title>
                        </div>
                        <div class='col-md-6'>
                            <img src='./admin_dash/vehicle_images/$vehicle_image3' class='card-img-top' alt=$vehicle_title>
                        </div>

                    </div>
                </div>
                ";
                }
            }
        }
    }
}
// get ip address function
function getIPAddress()
{
    //whether ip is from the share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function book()
{
    if (isset($_GET['add_to_booking'])) {
        global $con;
        $get_ip = getIPAddress();
        $get_vehicle_id = $_GET['add_to_booking'];

        // Check if the vehicle is already present in bookings for the given IP address
        $select_query = "SELECT * FROM `bookings` WHERE ip_address='$get_ip' AND vehicle_id='$get_vehicle_id'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);

        if ($num_of_rows > 0) {
            // Vehicle is already present in bookings
            echo "<script>alert('Vehicle is already booked')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            // Vehicle is not present in bookings, so insert it
            $insert_query = "INSERT INTO `bookings` (vehicle_id, ip_address, days) VALUES ('$get_vehicle_id', '$get_ip', 0)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script>alert('Vehicle booked')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}


function cost_to_hire()
{
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
            $total_price += $vehicle_price_result;
        }
    }
    echo $total_price;
}


function get_user_order_details()
{
    global $con;
    $username = $_SESSION['user_username'];
    $get_details = "SELECT * FROM `customer_table` WHERE username = '$username'";
    $result_query = mysqli_query($con, $get_details);

    if ($result_query) {
        $row_count = mysqli_num_rows($result_query);

        if ($row_count > 0) {
            $row_query = mysqli_fetch_array($result_query);
            $user_id = $row_query['user_id'];

            if (!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])) {
                $get_orders = "SELECT * FROM `customer_table` WHERE user_id = $user_id AND order_status = 'pending'";
                $result_order_query = mysqli_query($con, $get_orders);

                if ($result_order_query) {
                    $row_count = mysqli_num_rows($result_order_query);

                    if ($row_count > 0) {
                        echo "<h2 class='text-center text-info mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h2>";
                        echo "<a href='profile.php?my_orders' class='text-center'>View order details</a>";
                    } else {
                        echo "<h2 class='text-center text-info mt-5 m-2'>You have no pending orders</h2>";
                        echo "<a href='index.php' class='text-center'>Explore</a>";
                    }
                } else {
                    echo "Error fetching order details: " . mysqli_error($con);
                }
            }
        }
    } else {
        echo "Error fetching user details: " . mysqli_error($con);
    }
}

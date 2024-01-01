<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/connect.php');
include('../functions/shared_func.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css -->
    <link rel="stylesheet" href="style.css">
    <style>
        .admin_image {
            width: 100px;
            object-fit: contain;
        }

        .v_img {
            width: 80%;
            max-width: 100px;
            height: auto;
            max-height: 80px;
        }
    </style>
</head>

<body>
    <!-- nav -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <i class="fa fa-road" aria-hidden="true"></i>

                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">Welcome to admin panel</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
        <!-- admin actions -->
        <div class="bg-light">
            <h3 class="text-center p-2">Admin Actions</h3>
        </div>
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 align-items-center d-flex">
                <div class="mx-4 p-2">
                                              <button class="my-3 p-0 btn bg-success b-0 mx-2">
                        <a href="./registration.php" class="nav-link text-success bg-black my-1">
                            Register new admin
                        </a>
                    </button>
                </div>
                <!-- actions -->
                <div class="button text-center">

                    <button class="my-3 btn p-0 bg-info b-0 mx-2">
                        <a href="insert_vehicle.php" class="nav-link text-info bg-secondary my-1">
                            Insert Vehicle
                        </a>
                    </button>
                    <button class="my-3 btn p-0 bg-info b-0 mx-2">
                        <a href="index.php?view_vehicle" class=" nav-link text-info bg-secondary my-1">
                            View vehicles
                        </a>
                    </button>
                    <button class="my-3 btn p-0 bg-info b-0 mx-2">
                        <a href="index.php?insert_category" class="nav-link text-info bg-secondary my-1">
                            Insert Categories
                        </a>
                    </button>
                    <button class="my-3 p-0 btn bg-info b-0 mx-2">
                        <a href="index.php?view_category" class="nav-link text-info bg-secondary my-1">
                            View Categories
                        </a>
                    </button>
                    <button class="my-3 p-0 btn bg-info b-0 mx-2">
                        <a href="index.php?insert_brand" class="nav-link text-info bg-secondary my-1">
                            Insert Brands
                        </a>
                    </button>
                    <button class="my-3 p-0 btn bg-info b-0 mx-2">
                        <a href="index.php?view_brand" class="nav-link text-info bg-secondary my-1">
                            View Brands
                        </a>
                    </button>
                    <button class="my-3 p-0 btn bg-info b-0 mx-2">
                        <a href="index.php?booking" class="nav-link text-info bg-secondary my-1">
                            All Bookings
                        </a>
                    </button>
                    <button class="my-3 p-0 btn bg-info b-0 mx-2">
                        <a href="index.php?customers" class="nav-link text-info bg-secondary my-1">
                            Registered Users
                        </a>
                    </button>
                    <button class="my-3 p-0 btn bg-info b-0 mx-2">
                        <a href="index.php?billing" class="nav-link text-info bg-secondary my-1">
                            Billing
                        </a>
                    </button>
                    <button class="my-3 p-0 btn bg-danger b-0 mx-2">
                        <a href="../user/logout.php" class="nav-link text-danger bg-secondary my-1">
                            Log Out
                        </a>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- section A -->
    <div class="container my-3">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        if (isset($_GET['insert_category'])) {
            include('insert_categories.php');
        }
        if (isset($_GET['insert_brand'])) {
            include('insert_brand.php');
        }
        if (isset($_GET['view_vehicle'])) {
            include('view_vehicle.php');
        }
        if (isset($_GET['edit'])) {
            include('edit.php');
        }
        if (isset($_GET['delete'])) {
            include('delete.php');
        }
        if (isset($_GET['view_category'])) {
            include('view_category.php');
        }
        if (isset($_GET['edit_cat'])) {
            include('edit_cat.php');
        }
        if (isset($_GET['delete_cat'])) {
            include('delete_cat.php');
        }
        if (isset($_GET['view_brand'])) {
            include('view_brand.php');
        }
        if (isset($_GET['edit_brand'])) {
            include('edit_brand.php');
        }
        if (isset($_GET['delete_brand'])) {
            include('delete_brand.php');
        }
        if (isset($_GET['booking'])) {
            include('booking.php');
        }
        if (isset($_GET['billing'])) {
            include('billing.php');
        }
        if (isset($_GET['customers'])) {
            include('customers.php');
        }
        ?>
    </div>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
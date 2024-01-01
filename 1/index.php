<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/connect.php');
include('functions/shared_func.php');
include('includes/header.php');
session_start();
?>

<title>Msafiri</title>
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
                                if (!isset($_SESSION['user_username'])) {
                                    echo '<li><a class="dropdown-item" href="user/user_login.php">Login</a></li>';
                                    echo '<li><a class="dropdown-item" href="user/user_registration.php">Register</a></li>';
                                } else {
                                    echo '<li><a class="dropdown-item" href="user/profile.php">Profile</a></li>';
                                    echo '<li><a class="dropdown-item" href="user/user_logout.php">Logout</a></li>';
                                }
                                ?>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="./admin_dash/login.php">Admin Login</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success fw-bold" href="checkout.php">Checkout Booking</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" name="search_data" type="search" placeholder="Search" aria-label="Search">
                        <input type="submit" value="search" class="btn btn-outline-success" name="search_data_btn">
                    </form>
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
    <!-- main section -->
    <div class="row">
        <div class="col-md-10">
            <!-- fleet -->
            <h4>overview</h4>
            <div class="row">
                <!-- from DB -->
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                search_vehicle();
                get_vehicles();
                get_specific_cat();
                get_specific_brand();
                ?>

            </div>
        </div>
        <!-- side-bar -->
        <div class="col-md-2 bg-info p-0">
            <!-- brands -->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-light">
                    <a href="#" class="nav-link">
                        <h4>Brands</h4>
                    </a>
                </li>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                get_brands();
                ?>
            </ul>
            <!-- categories -->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-light">
                    <a href="#" class="nav-link">
                        <h4>category</h4>
                    </a>
                </li>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                get_category();
                ?>
            </ul>

        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>
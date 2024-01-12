<?php
include('../includes/connect.php');
include('../functions/shared_func.php');
include('../includes/header.php');
session_start();
?>

<title>Msafiri</title>
<style>
    .profile_img {
        width: 100%;
        max-width: 250px;
        height: auto;
        max-height: 300px;
    }
</style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php"><i class="fa fa-road" aria-hidden="true"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../fleet.php">Fleet</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>Account
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                if (!isset($_SESSION['user_username'])) {
                                    echo '<li><a class="dropdown-item" href="user/user_login.php">Login</a></li>';
                                    echo '<li><a class="dropdown-item" href="user/user_registration.php">Register</a></li>';
                                } else {
                                    echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
                                }
                                ?>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Admin Login</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success fw-bold" href="../checkout.php">Checkout Booking</a>
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
    <!-- hero -->
    <div class=" bg-light">
        <h3 class="text-center">Lorem ipsum dolor sit amet.</h3>
        <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, perferendis! Debitis, a quod. Laborum fuga laudantium quisquam, asperiores ea quam illum nam sed minima maxime!</p>
    </div>
    <div class="row">
        <div class="col-md-2 bg-warning p-0">
            <ul class="navbar-nav me-auto text-center" style="height:80vh">
                <li class="nav-item bg-warning">
                    <h4 class="nav-item">Your Profile</h4>
                </li>
                <?php
                $username = $_SESSION['user_username'];
                $user_image_query = "SELECT * FROM `customer_table` WHERE user_name = '$username'";
                $result_image = mysqli_query($con, $user_image_query);
                $row_image = mysqli_fetch_array($result_image);
                $user_image = $row_image['user_image'];
                echo "<li class='nav-item'>
                        <img src='./user_images/$user_image' class='profile_img my-4'>
                    </li>";
                ?>

                <li class="nav-item"><a href="profile.php" class="nav-link text-dark">Pending Orders</a></li>
                <li class="nav-item"><a href="profile.php?edit_account" class="nav-link text-dark">Edit Account</a></li>
                <li class="nav-item"><a href="profile.php?my_orders" class="nav-link text-dark">My Orders</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-info">Log Out</a></li>
                <li class="nav-item mt-5"><a href="profile.php?delete_account" class="nav-link text-danger">Delete Account</a></li>
            </ul>
        </div>
        <div class="col-md-10 text-center">
            <?php
            if (isset($_GET['edit_account'])) {
                include('edit_account.php');
            }
            if (isset($_GET['my_orders'])) {
                include('my_orders.php');
            }
            if (isset($_GET['delete_account'])) {
                include('delete_account.php');
            }
            get_user_order_details();
            ?>
        </div>
</body>
<?php
include('../includes/footer.php');
?>
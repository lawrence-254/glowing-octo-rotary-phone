<!DOCTYPE html>
<?php
include('.//includes/connect.php');
include('../includes/header.php');
session_start();


?>
<title>Payment</title>
</head>

<body>
    <div class="custom-div d-flex justify-content-center align-items-center" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80%; height: 80%; border: 10px solid green;">
        <!-- Content goes here -->
        <?php
        if (!isset($_SESSION['user_username'])) {
            sleep(2);
            include('user_login.php');
        } else {
            include('payment.php');
        }
        ?>
    </div>
</body>

</html>
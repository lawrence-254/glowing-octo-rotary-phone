<?php
include('../includes/connect.php');
include('../functions/shared_func.php');
include('../includes/header.php');
session_start();
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM `order` WHERE order_id = '$order_id'";
    $result_data = mysqli_query($con, $select_data);

    if ($result_data) {
        $row_fetch = mysqli_fetch_assoc($result_data);
        $order_number = $row_fetch['order_number'];
        $cost = $row_fetch['cost'];
    } else {
        echo "Error fetching order data: " . mysqli_error($con);
    }
}
if (isset($_POST['confirm_payment'])) {
    $order_number_form = $_POST['order_number'];
    $amount_form = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "INSERT INTO `payments` (order_id, order_no, amount, payment_method, date)
                     VALUES ($order_id, '$order_number_form', $amount_form, '$payment_mode', NOW())";
    $result = mysqli_query($con, $insert_query);

    if ($result) {
        echo "<h3 class='text-center text-success'>Payment Successful</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    } else {
        echo "<h3 class='text-center text-danger'>Payment unsuccessful</h3>";
        echo "Error inserting payment data: " . mysqli_error($con);
    }
    $update_order = "update `order` set order_status = 'Complete'where order_id =$order_id";
    $result_update = mysqli_query($con, $update_order);
    
}


?>

<title>Confirm payment</title>
</head>

<body class="bg-secondary">
    <h1 class="text-center text-warning my-4">Confirm Payment</h1>
    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-80 m-auto">
                <input type="text" name="order_number" class="form-control w-50 m-auto" value="<?php echo $order_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-80 m-auto">
                <label for="amount" class="text-center text-warning">Amount</label>
                <input type=" text" name="amount" class="form-control w-50 m-auto">
            </div>
            <div class="form-outline my-4 text-center w-80 m-auto">
                <select name="payment_mode" class="form-control w-50 m-auto">
                    <option value="">Select Payment Method</option>
                    <option value="">Bank</option>
                    <option value="">Mpesa</option>
                    <option value="">Airtel Money</option>
                    <option value="">Cash on Collection/Delivery</option>
                    <option value="">Pay Offline</option>
                </select>
            </div>
            <div class="form-outline mt-5 text-center w-80 m-auto">
                <input type="submit" name="confirm_payment" class="form-control w-50 m-auto bg-info py-2 border-0" value="Complete Payment">
            </div>
        </form>
    </div>

</body>

</html>
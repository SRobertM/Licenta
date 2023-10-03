<?php
include('../includes/connect.php');
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM `user_orders` WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);

    if ($row_fetch) {
        $invoice_number = $row_fetch['invoice_number'];
        $amount_due = $row_fetch['ammount_due'];

        if (isset($_POST['confirm_payment'])) {
            $input_invoice_number = $_POST['invoice_number'];
            $amount = $_POST['amount'];
            $payment_mode = $_POST['payment_mode'];

            // Check if the entered invoice number matches the order ID
            if ($input_invoice_number == $invoice_number) {

                // Disable foreign key checks
                mysqli_query($con, 'SET FOREIGN_KEY_CHECKS = 0');

                $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, ammount, payment_mode, date) VALUES ($order_id, '$invoice_number', $amount, '$payment_mode', NOW())";
                $result = mysqli_query($con, $insert_query);

                // Enable foreign key checks
                mysqli_query($con, 'SET FOREIGN_KEY_CHECKS = 1');

                if ($result) {
                    echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
                    echo "<script>window.open('profile.php?my_orders', '_self')</script>";

                    // Update the order status
                    $update_orders = "UPDATE `user_orders` SET order_status='Completa' WHERE order_id=$order_id";
                    $result_orders = mysqli_query($con, $update_orders);
                } else {
                    echo "<h3 class='text-center text-light'>Failed to complete the payment</h3>";
                    echo mysqli_error($con);
                }
            } else {
                echo "<h3 class='text-center text-light'>Invalid invoice number</h3>";
            }
        }
    } else {
        echo "<h3 class='text-center text-light'>Invalid order ID</h3>";
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay page</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Confirma Plata</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number"
                    value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Suma</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option value="Bitcoin">Bitcoin</option>
                    <option value="BancaTransilvania">Banca Transilvania</option>
                    <option value="Revolut">Revolut</option>
                    <option value="Cash la fata locului">Cash la fata locului</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirma" name=confirm_payment>
            </div>
        </form>
    </div>

</body>
</html>
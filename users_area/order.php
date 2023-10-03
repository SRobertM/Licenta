<?php
include('../includes/connect.php');
include('../functions/common_function.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

// Get the IP address
$get_ip_address = getIPAddress();

// Calculate the total price and number of products in the cart
$total_price = 0;
$count_products = 0;
$cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query_price);
$invoice_number = mt_rand();
$status = 'pending';

// Retrieve the generated order_id
$order_id = null;

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['ID_Vanzator'];
    $select_product = "SELECT * FROM `vanzatori` WHERE ID_Vanzator=$product_id";
    $run_price = mysqli_query($con, $select_product);

    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = array($row_product_price['Pret']);
        $product_values = array_sum($product_price);
        $total_price += $product_values;
        $count_products++;
    }

    if (!$order_id) {
        // Insert order into `user_orders` table
        $insert_orders = "INSERT INTO `user_orders` (user_id, ammount_due, invoice_number, total_taskers, order_date, order_status) VALUES ($user_id, 0, $invoice_number, 0, NOW(), '$status')";
        $result_query = mysqli_query($con, $insert_orders);

        if ($result_query) {
            // Retrieve the generated order_id
            $order_id = mysqli_insert_id($con);
        } else {
            echo "<script>alert('Fail')</script>";
            echo mysqli_error($con);
            exit; // Stop further execution if there is an error
        }
    }

    // Only insert tasker IDs into `order_taskers` table
    $insert_order_tasker = "INSERT INTO `order_taskers` (order_id, ID_Vanzator) VALUES ($order_id, $product_id)";
    $result_order_tasker = mysqli_query($con, $insert_order_tasker);

    if (!$result_order_tasker) {
        echo "<script>alert('Fail tasker ID: $product_id')</script>";
        echo mysqli_error($con);
        exit; // Stop further execution if there is an error
    }
}

// Update the ammount_due in `user_orders` table
$update_ammount_due = "UPDATE `user_orders` SET ammount_due = $total_price, total_taskers = $count_products WHERE order_id = $order_id";
$result_update_ammount_due = mysqli_query($con, $update_ammount_due);

if ($result_update_ammount_due) {
    // Update the quantity in `orders_pending` table based on the order ID
    $update_quantity = "UPDATE `orders_pending` SET quantity = $count_products WHERE order_id = $order_id";
    $result_update_quantity = mysqli_query($con, $update_quantity);

    if ($result_update_quantity) {
        // Delete items from cart_details table
        $empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
        $result_delete = mysqli_query($con, $empty_cart);

        if ($result_delete) {
            echo "<script>alert('Salvata cu succes')</script>";
            echo "<script>window.open('profile.php', '_self')</script>";
        } else {
            echo "<script>alert('Fail')</script>";
            echo mysqli_error($con);
        }
    } else {
        echo "<script>alert('Fail')</script>";
        echo mysqli_error($con);
    }
} else {
    echo "<script>alert('Fail')</script>";
    echo mysqli_error($con);
}


?>

<?php
if (isset($_GET['delete_orders'])) {
    $delete_order = $_GET['delete_orders'];
    
    // Delete from user_orders table
    $delete_user_orders_query = "DELETE FROM `user_orders` WHERE order_id=$delete_order";
    $result_user_orders = mysqli_query($con, $delete_user_orders_query);
    
    // Delete from orders_pending table
    $delete_orders_pending_query = "DELETE FROM `orders_pending` WHERE order_id=$delete_order";
    $result_orders_pending = mysqli_query($con, $delete_orders_pending_query);
    
    if ($result_user_orders && $result_orders_pending) {
        echo "<script>alert('Cmd stearsa cu succes')</script>";
        echo "<script>window.open('./index.php?view_categories', '_self')</script>";
    } else {
        echo "<script>alert('Fail')</script>";
    }
}

?>

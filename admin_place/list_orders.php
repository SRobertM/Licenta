<h3 class="text-center text-success">Toate comenzile</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
    <?php
    $get_orders = "SELECT * FROM `user_orders`";
    $result = mysqli_query($con, $get_orders);
    $row_count = mysqli_num_rows($result);
    echo "
    <tr>
        <th>Nr Cmd</th>
        <th>Suma de plata</th>
        <th>Nr Factura</th>
        <th>Total taskers</th>
        <th>Data efectuarii</th>
        <th>Status</th>
        <th>Delete</th>
        <th>Factura</th>
    </tr>
    </thead>
    <tbody class='bg-secondary text-light'>";
    
    if ($row_count == 0) {
        echo "<h2 class='bg-danger text-center mt-5'>Nu exista nici o cmd momentan</h2>";
    } else {
        $number = 0;
        while ($row_data = mysqli_fetch_assoc($result)) {
            $order_id = $row_data['order_id'];
            $user_id = $row_data['user_id'];
            $amount_due = $row_data['ammount_due'];
            $invoice_number = $row_data['invoice_number'];
            $total_products = $row_data['total_taskers'];
            $order_date = $row_data['order_date'];
            $order_status = $row_data['order_status'];
            $number++;
            echo "
            <tr>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$invoice_number</td>
                <td>$total_products</td>
                <td>$order_date</td>
                <td>$order_status</td>
                <td><a href='index.php?delete_orders=$order_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                <td>";
            if ($order_status == 'Completa') {
                echo "<a href='../generatePDF.PHP?order_id=$order_id' class='text-light'>Download</a>";
            }
            echo "</td>
            </tr>";
        }
    }
    ?>
    </tbody>
</table>

<?php
if (isset($_GET['delete_orders'])) {
    $delete_order = $_GET['delete_orders'];
    // echo $delete_category;
    $delete_query = "DELETE FROM `user_orders` WHERE order_id=$delete_order";
    $result = mysqli_query($con, $delete_query);
    if ($result) {
        echo "<script>alert('Order has been deleted successfully')</script>";
        echo "<script>window.open('index.php?view_categories', '_self')</script>";
    }
}
?>

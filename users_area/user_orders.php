<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User_orders</title>
</head>

<body>
    <?php
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user_table` WHERE username='$username'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];
    ?>
    <h3 class="text-success">Toate comenzile mele</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>Nr comanda</th>
                <th>De plata</th>
                <th>Total taskers</th>
                <th>Nr Factura</th>
                <th>Status</th>
                <th>Data</th>
                <th>Completa/Incompleta</th>
                <th>Factura</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_order_details = "SELECT * FROM `user_orders` WHERE user_id=$user_id";
            $result_orders = mysqli_query($con, $get_order_details);
            $number = 1;
            while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                $order_id = $row_orders['order_id'];
                $amount_due = $row_orders['ammount_due'];
                $total_products = $row_orders['total_taskers'];
                $invoice_number = $row_orders['invoice_number'];
                $order_status = $row_orders['order_status'];
                if ($order_status == 'pending') {
                    $order_status = 'Incompleta';
                } else {
                    $order_status = 'Completa';
                }
                $order_date = $row_orders['order_date'];
                echo "   <tr>
        <td>$order_id</td>
        <td>$amount_due</td>
        <td>$total_products</td>
        <td>$invoice_number</td>
        <td>$order_status</td>
        <td>$order_date</td>";

                if ($order_status == 'Completa') {
                    echo "<td>Platita</td>";
                } else {
                    echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirma</a></td>";
                }

                if ($order_status == 'Completa') {
                    echo "<td><a href='../generatePDF.PHP?order_id=$order_id' class='text-light'>Download</a></td>";
                } else {
                    echo "<td></td>";
                }

                echo "</tr>";
                $number++;
            }
            ?>
        </tbody>
    </table>
</body>


</html>
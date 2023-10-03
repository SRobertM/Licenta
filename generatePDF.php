<?php
require("fpdf/fpdf.php");
include('includes/connect.php');

// Retrieve data from the database
$order_id = $_GET['order_id'];

$get_taskers = "SELECT ot.order_id, v.Nume_Vanzator, v.Pret
                FROM order_taskers AS ot
                INNER JOIN vanzatori AS v ON v.ID_Vanzator = ot.ID_Vanzator
                WHERE ot.order_id = $order_id";

$taskers_result = mysqli_query($con, $get_taskers);
$taskers_data = mysqli_fetch_all($taskers_result, MYSQLI_ASSOC);

$products_info = [];

// Loop through tasker data and populate products_info array
foreach ($taskers_data as $tasker_data) {
    $product_info = [
        "name" => $tasker_data['Nume_Vanzator'], 
        "price" => $tasker_data['Pret'],
        "qty" => 1,
        "total" => $tasker_data['Pret']
    ];
    $products_info[] = $product_info;
}

// Retrieve user data from user_table based on order_id
$get_user = "SELECT u.*, uo.ammount_due, uo.invoice_number, uo.order_date
             FROM user_table AS u
             INNER JOIN user_orders AS uo ON uo.user_id = u.user_id
             WHERE uo.order_id = $order_id";

$user_result = mysqli_query($con, $get_user);
$user_data = mysqli_fetch_assoc($user_result);

// Check if the user data exists
if ($user_data) {
    $customer = $user_data['username']; 
    $address = $user_data['user_address']; 
    $mobile = $user_data['user_mobile'];
    $invoice_no = $user_data['invoice_number'];
    $invoice_date = $user_data['order_date'];

    // Get the total_amt from user_orders table
    $total_amt = $user_data['ammount_due'];

    //customer and invoice details
    $info = [
      "customer" => $customer,
      "address" => $address,
      "mobile" => $mobile,
      "invoice_no" => $invoice_no,
      "invoice_date" => $invoice_date,
      "total_amt" => "$total_amt Euro",
      
    ];

    class PDF extends FPDF
    {
        function Header()
        {
            // Display Company Info
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(50, 10, "Stor SRL.", 0, 1);
            $this->SetFont('Arial', '', 14);
            $this->Cell(50, 7, "Strada Fictiva nr 13,", 0, 1);
            $this->Cell(50, 7, "Bucuresti.", 0, 1);
            $this->Cell(50, 7, "PH : 8778731770", 0, 1);

            // Display INVOICE text
            $this->SetY(15);
            $this->SetX(-40);
            $this->SetFont('Arial', 'B', 18);
            $this->Cell(50, 10, "Factura", 0, 1);

            // Display Horizontal line
            $this->Line(0, 48, 210, 48);
        }

        function body($info, $products_info)
        {
            // Billing Details
            $this->SetY(55);
            $this->SetX(10);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(50, 10, "Catre: ", 0, 1);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 7, $info["customer"], 0, 1);
            $this->Cell(50, 7, $info["address"], 0, 1);
            $this->Cell(50, 7, $info["mobile"], 0, 1);

            // Display Invoice no
            $this->SetY(55);
            $this->SetX(-60);
            $this->Cell(50, 7, "Nr Factura : " . $info["invoice_no"]);

            // Display Invoice date
            $this->SetY(63);
            $this->SetX(-60);
            $this->Cell(50, 7, "Data: " . $info["invoice_date"]);

            // Display Table headings
            $this->SetY(95);
            $this->SetX(10);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(80, 9, "Descriere", 1, 0);
            $this->Cell(40, 9, "Pret", 1, 0, "C");
            $this->Cell(30, 9, "Cantiate", 1, 0, "C");
            $this->Cell(40, 9, "TOTAL", 1, 1, "C");
            $this->SetFont('Arial', '', 12);

            // Display table product rows
            foreach ($products_info as $row) {
                $this->Cell(80, 9, $row["name"], "LR", 0);
                $this->Cell(40, 9, $row["price"], "R", 0, "R");
                $this->Cell(30, 9, $row["qty"], "R", 0, "C");
                $this->Cell(40, 9, $row["total"], "R", 1, "R");
            }

            // Display table empty rows
            for ($i = 0; $i < 12 - count($products_info); $i++) {
                $this->Cell(80, 9, "", "LR", 0);
                $this->Cell(40, 9, "", "R", 0, "R");
                $this->Cell(30, 9, "", "R", 0, "C");
                $this->Cell(40, 9, "", "R", 1, "R");
            }

            // Display table total row
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(150, 9, "TOTAL", 1, 0, "R");
            $this->Cell(40, 9, $info["total_amt"], 1, 1, "R");

            
        }

        function Footer()
        {
            // Set footer position
            $this->SetY(-50);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, "Stor SRL.", 0, 1, "R");
            $this->Ln(15);
            $this->SetFont('Arial', '', 12);
            $this->Cell(0, 10, "Semnatura", 0, 1, "R");
            $this->SetFont('Arial', '', 10);

            
        }
    }

    $pdf = new PDF("P", "mm", "A4");
    $pdf->AddPage();
    $pdf->body($info, $products_info);
    $pdf->Output();
} else {
    // Handle case when user data is not found for the given order_id
    echo "User data not found.";
}

?>

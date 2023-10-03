<form action="" method="post" class="mb-2 text-center">
    <div class="input-group w-50 mx-auto mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"> </i></span>
        <input type="text" class="form-control" name="seller" aria-label="sellers" placeholder="Vanzator"
            aria-describedby="Vanzator">
    </div>
    <div class="input-group w-25 mx-auto mb-2 d-flex justify-content-start">
        <input type="submit" class="form-control bg-info" name="insert_sellers" value="Adauga" aria-describedby="Vanzator">
    </div>
</form>

<?php
include('../includes/connect.php');
if (isset($_POST['insert_sellers'])) {
    $seller_name = mysqli_real_escape_string($con, $_POST['seller']); 
    $select_query = "SELECT * FROM `vanzatori` WHERE Nume_Vanzator='$seller_name'";
    $result_select= mysqli_query($con, $select_query); // 
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('Vanzatorul exista deja')</script>";
    } else {
        $insert_query = "INSERT INTO `vanzatori` (`Nume_Vanzator`) VALUES ('$seller_name')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Vanzatorul fost adaugat')</script>";
        } else {
            echo mysqli_error($con); // Display error message if query fails
        }
    }
}
?>

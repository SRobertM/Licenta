<?php
include('../includes/connect.php');
if (isset($_POST['insert_location'])) {
    $location_name = mysqli_real_escape_string($con, $_POST['location']); // Escape special characters in the input
    $select_query = "SELECT * FROM `locatie` WHERE Nume_Locatie='$location_name'";
    $result_select= mysqli_query($con, $select_query); // 
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('Locatia exista deja')</script>";
    } else {
        $insert_query = "INSERT INTO `locatie` (`Nume_Locatie`) VALUES ('$location_name')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Locatia a fost adaugata')</script>";
        } else {
            echo mysqli_error($con); // Display error message if query fails
        }
    }
}
?>



<form action="" method="post" class="mb-2 text-center">
    <div class="input-group w-50 mx-auto mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"> </i></span>
        <input type="text" class="form-control" name="location" aria-label="locations" placeholder="Locatie"
            aria-describedby="Locatie">
    </div>
    <div class="input-group w-25 mx-auto mb-2 d-flex justify-content-start">
        <input type="submit" class="form-control bg-info" name="insert_location" value="Adauga"
            aria-describedby="Locatie">
    </div>
</form>
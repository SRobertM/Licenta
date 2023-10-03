<?php
if(isset($_GET['edit_locations'])){
    $edit_locations= $_GET['edit_locations'];
    // echo $edit_location;
    $get_locations = "SELECT * FROM `locatie` WHERE ID_Locatie =  $edit_locations";
    $result = mysqli_query($con, $get_locations);
    $row = mysqli_fetch_assoc($result);
    $location_title = $row['Nume_Locatie'];
    // echo $location_title;
}

if(isset($_POST['edit_loc'])){
    $loc_title = $_POST['location_title'];
    $update_query = "UPDATE `locatie` SET Nume_Locatie = '$loc_title' WHERE ID_Locatie =  $edit_locations";
    $result_loc = mysqli_query($con, $update_query);
    if($result_loc){
        echo "<script>alert('location has been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_locations.php', '_self')</script>";
        // Redirect to the desired page after successful update
    } else {
        echo "<script>alert('Failed to update location')</script>";
    }
}
?>

<div class="container mt-3">
    <h1 class="text-center">Editeaza Locatia</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="location_title" class="form-label">Denumire</label>
            <input type="text" name="location_title" id="location_title" class="form-control" required="required" value="<?php echo $location_title ?>">
        </div>
        <input type="submit" value="Update" class="btn btn-info px-3 mb-3" name="edit_loc">
    </form>
</div>

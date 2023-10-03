<?php
if (isset($_GET['delete_locations'])) {
    $delete_location = $_GET['delete_locations'];
    // echo $delete_category;
    $delete_query = "Delete from `locatie` where ID_Locatie=$delete_location";
    $result = mysqli_query($con, $delete_query);
    if ($result) {
    }
    echo "<script>alert('Location is been Deleted successfully')</ script>";
    echo "<script>window.open('./index.php?view_categories', '_self')</ script>";
}
?>
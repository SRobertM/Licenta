<?php
include('../includes/connect.php');
if (isset($_POST['insert_categorys'])) {
    $category_name = mysqli_real_escape_string($con, $_POST['category']); // Escape special characters in the input
    $select_query = "SELECT * FROM `categorii` WHERE Nume_Categorie='$category_name'";
    $result_select= mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('Categoria exista deja')</script>";
    } else {
        $insert_query = "INSERT INTO `categorii` (`Nume_Categorie`) VALUES ('$category_name')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Categoria a fost adaugata')</script>";
        } else {
            echo mysqli_error($con); // Display error message if query fails
        }
    }
}
?>

<form action="" method="post" class="mb-2 text-center">
    <div class="input-group w-50 mx-auto mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"> </i></span>
        <input type="text" class="form-control" name="category" aria-label="category" placeholder="Categorie"
            aria-describedby="Categorie">
    </div>
    <div class="input-group w-25 mx-auto mb-2 d-flex justify-content-start">
        <input type="submit" class="form-control bg-info" name="insert_categorys" value="Adauga" aria-describedby="Categorie">
    </div>
</form>

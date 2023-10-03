<?php
if(isset($_GET['edit_categories'])){
    $edit_category = $_GET['edit_categories'];
    // echo $edit_category;
    $get_categories = "SELECT * FROM `categorii` WHERE ID_Categorie = $edit_category";
    $result = mysqli_query($con, $get_categories);
    $row = mysqli_fetch_assoc($result);
    $category_title = $row['Nume_Categorie'];
    // echo $category_title;
}

if(isset($_POST['edit_cat'])){
    $cat_title = $_POST['category_title'];
    $update_query = "UPDATE `categorii` SET Nume_Categorie = '$cat_title' WHERE ID_Categorie = $edit_category";
    $result_cat = mysqli_query($con, $update_query);
    if($result_cat){
        echo "<script>alert('Category has been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_categories.php', '_self')</script>";
        // Redirect to the desired page after successful update
    } else {
        echo "<script>alert('Failed to update category')</script>";
    }
}
?>

<div class="container mt-3">
    <h1 class="text-center">Editeaza Categoria</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Denumire</label>
            <input type="text" name="category_title" id="category_title" class="form-control" required="required" value="<?php echo $category_title ?>">
        </div>
        <input type="submit" value="Update" class="btn btn-info px-3 mb-3" name="edit_cat">
    </form>
</div>

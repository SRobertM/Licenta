<?php
if (isset($_GET['edit_taskers'])) {
    $edit_id = $_GET['edit_taskers'];
    $get_data = "SELECT * FROM `vanzatori` WHERE ID_Vanzator=$edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['Nume_Vanzator'];
    $product_description = $row['Descriere_Vanzator'];
    $product_keyword = $row['Keyword_Vanzator'];
    $category_id = $row['ID_Categorie'];
    $location_id = $row['ID_Locatie'];
    $product_image1 = $row['tasker_image1'];
    $product_image2 = $row['tasker_image2'];
    $product_image3 = $row['tasker_image3'];
    $product_price = $row['Pret'];

    //fetching category
    $select_category = "SELECT * FROM `categorii` WHERE ID_Categorie=$category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['Nume_Categorie'];



    //fetching location
    $select_location = "SELECT * FROM `locatie` WHERE ID_Locatie=$location_id";
    $result_location = mysqli_query($con, $select_location);
    $row_location = mysqli_fetch_assoc($result_location);
    $location_title = $row_location['Nume_Locatie'];



}

?>
<div class="container mt-5">
    <h1 class="text-center">Edit Taskers</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto">
            <label for="product_title" class="form-label">Nume Tasker</label>
            <input type="text" id="product_title" name="product_title" value="<?php echo $product_title; ?>"" class="
                form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto">
            <label for="product_desc" class="form-label">Descriere Tasker</label>
            <input type="text" id="product_desc" name="product_desc" value="<?php echo $product_description; ?>"
                class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto">
            <label for="product_keywords" class="form-label">Tasker Keywords</label>
            <input type="text" id="product_keywords" name="product_keywords" value="<?php echo $product_keyword; ?>"
                class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Categoria</label>
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                <?php
                $select_category_all = "SELECT * FROM `categorii`";
                $result_category_all = mysqli_query($con, $select_category_all);
                while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_id_all = $row_category_all['ID_Categorie'];
                    $category_title_all = $row_category_all['Nume_Categorie'];
                    echo "<option value='$category_id_all'>$category_title_all</option>";
                }
                ?>
            </select>

        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_locations" class="form-label">Locatia</label>
            <select name="product_locations" class="form-select">
                <option value="<?php echo $location_id; ?>"><?php echo $location_title; ?></option>
                <?php
                $select_location_all = "SELECT * FROM `locatie`";
                $result_location_all = mysqli_query($con, $select_location_all);
                while ($row_location_all = mysqli_fetch_assoc($result_location_all)) {
                    $location_id_all = $row_location_all['ID_Locatie'];
                    $location_title_all = $row_location_all['Nume_Locatie'];
                    echo "<option value='$location_id_all'>$location_title_all</option>";
                }
                ?>
            </select>

        </div>
        <div class="form-outline w-50 m-auto">
            <label for="product_image1" class="form-label">Tasker IMG 1</label>
            <div class="d-flex">
                <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto">
                <img src="../images/<?php echo $product_image1; ?>" alt="" class="product_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto">
            <label for="product_image2" class="form-label">Tasker IMG 2</label>
            <div class="d-flex">
                <input type="file" id="product_image2" name="product_image2" class="form-control w-90 m-auto">
                <img src="../images/<?php echo $product_image2; ?>" alt="" class="product_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto">
            <label for="product_image3" class="form-label">Tasker IMG 3</label>
            <div class="d-flex">
                <input type="file" id="product_image3" name="product_image3" class="form-control w-90 m-auto">
                <img src="../images/<?php echo $product_image3; ?>" alt="" class="product_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto">
            <label for="product_price" class="form-label">Pret</label>
            <input type="text" id="product_price" name="product_price" value="<?php echo $product_price; ?>"
                class="form-control">
        </div>
        <div class="text-center">
            <button type="submit" name="edit_product" value="Update Product">Salveaza</button>
        </div>
    </form>
</div>


<!--edit -->

<?php
if (isset($_POST['edit_product'])) {
    $edit_id = $_GET['edit_taskers'];
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_desc'];
    $product_keyword = $_POST['product_keywords'];
    $category_id = $_POST['product_category'];
    $location_id = $_POST['product_locations'];
    $product_price = $_POST['product_price'];

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Checking for fields empty or not
    if (
        $product_title == '' || $product_description == '' || $product_keyword == '' ||
        $category_id == '' || $location_id == '' || $product_price == ''
    ) {
        echo "<script> alert('Please fill all the fields and continue the process')</script>";
    } else {
        // Check if the file has been uploaded successfully
        if (
            isset($_FILES['product_image1']['error']) && $_FILES['product_image1']['error'] === UPLOAD_ERR_OK &&
            isset($_FILES['product_image2']['error']) && $_FILES['product_image2']['error'] === UPLOAD_ERR_OK &&
            isset($_FILES['product_image3']['error']) && $_FILES['product_image3']['error'] === UPLOAD_ERR_OK
        ) {

            // Move uploaded files to destination directory
            move_uploaded_file($temp_image1, "../images/$product_image1");
            move_uploaded_file($temp_image2, "../images/$product_image2");
            move_uploaded_file($temp_image3, "../images/$product_image3");

            // Query to update products
            $update_product = "UPDATE `Vanzatori` SET Nume_Vanzator='$product_title',
            Descriere_Vanzator='$product_description', Keyword_Vanzator='$product_keyword',
            ID_Categorie='$category_id', ID_Locatie='$location_id',
            tasker_image1='$product_image1', tasker_image2='$product_image2',
            tasker_image3='$product_image3', Pret='$product_price', date=NOW()
            WHERE ID_Vanzator=$edit_id";

            // Execute the query
            $result_update = mysqli_query($con, $update_product);

            if ($result_update) {
                echo "<script> alert('Product updated successfully')</script>";
                echo "<script>window.open('./index.php', '_self')</script>";
            } else {
                echo "<script> alert('Failed to update product')</script>";
                
            }
        } else {
            echo "<script> alert('Failed to upload files')</script>";
        }
    }
}
?>
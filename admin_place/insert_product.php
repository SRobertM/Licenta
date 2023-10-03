<!--connection file-->
<?php
include('../includes/connect.php');
if (isset($_POST['insert_product'])) {
    $tasker_title = $_POST['tasker_title'];
    $description = $_POST['description'];
    $tasker_keywords = $_POST['tasker_keywords'];
    $tasker_categories = $_POST['tasker_categories'];
    $tasker_location = $_POST['tasker_location'];
    $tasker_price = $_POST['tasker_price'];
    $tasker_status = 'true';

    //accesing images   
    $tasker_image1 = $_FILES['tasker_image1']['name'];
    $tasker_image2 = $_FILES['tasker_image2']['name'];
    $tasker_image3 = $_FILES['tasker_image3']['name'];

    //accesing image temp names

    $tasker_image1_tmp = $_FILES['tasker_image1']['tmp_name'];
    $tasker_image2_tmp = $_FILES['tasker_image2']['tmp_name'];
    $tasker_image3_tmp = $_FILES['tasker_image3']['tmp_name'];


    //checking empty condition
    if (
        $tasker_title == '' or $description == '' or $tasker_keywords == '' or $tasker_categories == '' or $tasker_location == '' or $tasker_price == '' or
        $tasker_image1 == '' or $tasker_image2 == '' or $tasker_image3 == ''
    ) {
        echo "<script>alert('Va rugam completati tot')</script>";
        exit();
    } else {
        move_uploaded_file($tasker_image1_tmp, "../images/$tasker_image1");
        move_uploaded_file($tasker_image2_tmp, "../images/$tasker_image2");
        move_uploaded_file($tasker_image3_tmp, "../images/$tasker_image3");

    }

    //insert querry
    $insert_taskers = "INSERT INTO `vanzatori` (Nume_Vanzator, Descriere_Vanzator, Keyword_Vanzator, ID_Categorie, ID_Locatie, tasker_image1, tasker_image2,
     tasker_image3, Pret, date, status) VALUES ('$tasker_title', '$description', '$tasker_keywords', '$tasker_categories', '$tasker_location', '$tasker_image1', '$tasker_image2', '$tasker_image3', '$tasker_price', NOW(), '$tasker_status')";
     
    $result_query = mysqli_query($con, $insert_taskers);
    if ($result_query) {
        echo "<script>alert('Adaugat cu succes')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adauga Tasker</title>
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--css-->
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Adauga tasker</h1>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
            <!--nume-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="tasker_title" class="form-label">Nume Tasker</label>
                <input type="text" name="tasker_title" id="tasker_title" class="form-control"
                    placeholder="Introdu numele" autocomplete="off" required="required">
            </div>
            <!--descriere-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Descriere</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Despre"
                    autocomplete="off" required="required">
            </div>
            <!--keywords-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="tasker-keywords" class="form-label">Keywords</label>
                <input type="text" name="tasker_keywords" id="tasker_keywords" class="form-control"
                    placeholder="Keyword" autocomplete="off" required="required">
            </div>
            <!--category-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="tasker_categories" id="" class="form-select">
                    <option value="">Alege Categoria</option>
                    <?php
                    $select_query = "SELECT * FROM `categorii`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['Nume_Categorie'];
                        $category_id = $row['ID_Categorie'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!--Location-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="tasker_location" id="" class="form-select">
                    <option value="">Alege Locatia</option>
                    <?php
                    $select_query = "SELECT * FROM `locatie`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $location_title = $row['Nume_Locatie'];
                        $location_id = $row['ID_Locatie'];
                        echo "<option value='$location_id'>$location_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!--Image1-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="tasker_image1" class="form-label">Imagine 1</label>
                <input type="file" name="tasker_image1" id="tasker_image1" class="form-control" required="required">
            </div>
            <!--Image2-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="tasker_image2" class="form-label">Imagine 2</label>
                <input type="file" name="tasker_image2" id="tasker_image2" class="form-control">
            </div>
            <!--Image3-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="tasker_image3" class="form-label">Imagine 3</label>
                <input type="file" name="tasker_image3" id="tasker_image3" class="form-control">
            </div>
            <!--Price-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="tasker_price" class="form-label">Pret</label>
                <input type="text" name="tasker_price" id="tasker_price" class="form-control" placeholder="EURO"
                    autocomplete="off" required="required">
            </div>
            <!--Save button-->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info" value="Salveaza">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <button onclick="window.history.back();" class="btn btn-info"><i class="fas fa-arrow-left"></i>
                    Back</button>
            </div>
        </form>

    </div>

</body>

</html>
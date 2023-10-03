<?php
include('../includes/connect.php');
include('../functions/common_function.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--css-->
    <link rel="stylesheet" href="../style.css">
    <style>
        .admin_img {
            width: 100px;
            object-fit: contain;
        }

        .button button {
            width: 30em;
            height: 2em;
        }
        .product_img{
            width: 100px;
            object-fit: contain;
        }
        .body{
            background-color: blueviolet;
        }
    </style>
</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0 ">
        <!--first child-->
        <nav class="navbar navbar-expang-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="" class="logo">

                <nav class="navbar navbar-expang-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Welcome Admin</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!--second child-->
        <div class="bg-light">
            <h3 class="text-center p-2">Administrare</h3>
        </div>

        <!--third child-->
        <div class="bg-secondary p-10 d-flex align-items-center">
            <div>
                <a href="#"><img src="../images/admin.png" alt="" class="admin_img"> </a>
                <p class="text-light text-center"> Robert S </p>
            </div>
            <div class="button text-center">
                <button><a href="insert_product.php" class="nav-link text-light bg-success my-1">Adauga
                        Vanzatori</a></button>
                <button><a href="index.php?view_taskers" class="nav-link text-light bg-success my-1">Afiseaza
                        Vanzatori</a></button>
                <button><a href="index.php?insert_categories" class="nav-link text-light bg-success my-1">Adauga
                        Categorie</a></button>
                <button><a href="index.php?view_categories" class="nav-link text-light bg-success my-1">Afiseaza Categoriile</a></button>
                <button><a href="index.php?insert_locations" class="nav-link text-light bg-success my-1">Adauga
                        Locatii</a></button>
                <button><a href="index.php?view_locations" class="nav-link text-light bg-success my-1">Afiseaza Locatii</a></button>
                <button><a href="index.php?list_orders" class="nav-link text-light bg-success my-1">Toate achiziile/vanzari</a></button>
                <button><a href="index.php?list_users" class="nav-link text-light bg-success my-1">Utilizatori</a></button>
                <button><a href="../index.php" class="nav-link text-light bg-success my-1">Logout</a></button>
            </div>
        </div>

        <!--forth child-->
        <div class="container my-4">
            <?php
            if (isset($_GET['insert_sellers'])) {
                include('insert_sellers.php');
            }
            if (isset($_GET['insert_locations'])) {
                include('insert_locations.php');
            }
            if (isset($_GET['insert_categories'])) {
                include('insert_categories.php');
            }
            if (isset($_GET['view_taskers'])) {
                include('view_taskers.php');
            }
            if (isset($_GET['edit_taskers'])) {
                include('edit_taskers.php');
            }
            if (isset($_GET['delete_tasker'])) {
                include('delete_tasker.php');
            }
            if (isset($_GET['view_categories'])) {
                include('view_categories.php');
            }
            if (isset($_GET['view_locations'])) {
                include('view_locations.php');
            }
            if (isset($_GET['edit_categories'])) {
                include('edit_categories.php');
            }
            if (isset($_GET['edit_locations'])) {
                include('edit_locations.php');
            }
            if (isset($_GET['delete_locations'])) {
                include('delete_locations.php');
            }
            if (isset($_GET['delete_categories'])) {
                include('delete_categories.php');
            }
            if (isset($_GET['list_orders'])) {
                include('list_orders.php');
            }
            if (isset($_GET['delete_orders'])) {
                include('delete_orders.php');
            }
            if (isset($_GET['list_users'])) {
                include('list_users.php');
            }
         
            
            ?>
        </div>
    </div>
    <?php // include("../includes/footer.php");
        ?>

    <!--bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>
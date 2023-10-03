<!--connection file-->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stor</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!--navbar-->
    <div class="container-fluid p-0 ">
        <!--first child-->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Acasa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Servicii</a>
                        </li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
            <a class='nav-link' href='./users_area/profile.php'>Contul Meu</a>
          </li>";
                        } else {
                            echo "<li class='nav-item'>
            <a class='nav-link' href='./users_area/user_registration.php'>Inregistrare</a>
          </li>";
                        }
                        ?>


                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-arrow-down"></i><sup>
                                    <?php cart_item(); ?>
                                </sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cost total:
                                <?php total_cart_price(); ?>
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data">
                        <input type="submit" value="Search" class="btn-outline-light" name="search_data_tasker">
                    </form>
                </div>
            </div>
        </nav>
        <!--calling cart function-->
        <?php
        cart();
        ?>



        <!--second child-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Bun venit Vizitator</a>
            </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Bun venit " . $_SESSION['username'] . "</a>
            </li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                <a class='nav-link' href='./users_area/user_login.php'>Login</a>
            </li>";
                } else {
                    echo "<li class='nav-item'>
                <a class='nav-link' href='./users_area/logout.php'>Logout</a>
            </li>";
                }
                ?>
            </ul>
        </nav>
        <!--third child-->
        <div class="bg-danger">
            <h3 class="text-center">Stor <h3>    
        </div>
        <!--fourth child-->
        <div class="row px-3">
            <div class="col-md-10">
                <!--products/services-->
                <div class="row">
                    <!--fething --products-->
                    <?php
                    // calling function
                    gettaskers();
                    get_unique_category();
                    get_unique_location();
                    ?>
                </div>
            </div>
            <!-- sidenav -->
            <div class="col-md-2 bg-secondary p-0">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item bg-info text-center">
                        <a href="#" class="nav-link text-light">
                            <h4>Locatii</h4>
                        </a>
                    </li>
                    <!-- locatiile in database -->
                    <?php
                    getlocation();
                    ?>
                </ul>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item bg-info text-center">
                        <a href="#" class="nav-link text-light">
                            <h4>Categorie</h4>
                        </a>
                        <?php
                        getcategory();
                        ?>
                </ul>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item bg-info text-center">
                        <a href="#" class="nav-link text-light">
                            <h4>Taskers</h4>
                        </a>
                        <?php
                        gettaskersname();
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <!--last child-->
        <?php include("./includes/footer.php");
        ?>
    </div>








    <!--bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>
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
    <style>
        .cart_img {
            width: 170px;
            height: 150px;
            object-fit: contain;
        }
    </style>
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
                    </ul>

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
                    <a class='nav-link' href='#'>Bun venit ".$_SESSION['username']."</a>
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
        </nav>
        <!--third child-->
        <div class="bg-light">
            <h3 class="text-center">Stor <h3>
        </div>
        <!--fourth child-->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">
                        <tbody>
                            <!--php code-->
                            <?php
                            global $con;
                            $get_ip_add = getIPAddress();
                            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
                            $result = mysqli_query($con, $cart_query);
                            $result_count = mysqli_num_rows($result);
                            if ($result_count > 0) {
                                echo "<thead>
                            <tr>
                                <th>Nume Tasker</th>
                                <th>Imagine Tasker</th>
                                <th>Disponibilitate</th>
                                <th>Pret</th>
                                <th>Sterge</th>
                                <th colspan='2'>Operatii</th>
                            </tr>
                        </thead>";
                                $total_price = 0; // Initialize total price to 0
                            
                                while ($row = mysqli_fetch_array($result)) {
                                    $tasker_id = $row['ID_Vanzator'];
                                    $select_products = "SELECT * FROM `vanzatori` WHERE ID_Vanzator='$tasker_id'";
                                    $result_products = mysqli_query($con, $select_products);
                                    while ($row_product_price = mysqli_fetch_array($result_products)) {
                                        $product_price = array($row_product_price['Pret']);
                                        $price_table = $row_product_price['Pret'];
                                        $tasker_title = $row_product_price['Nume_Vanzator'];
                                        $tasker_image1 = $row_product_price['tasker_image1'];
                                        $tasker_values = array_sum($product_price);
                                        $total_price += $tasker_values;
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $tasker_title ?>
                                            </td>
                                            <td><img src="./images/<?php echo $tasker_image1 ?>" alt="" class="cart_img"></td>
                                            <td></td>
                                            <td>
                                                <?php
                                                $get_ip_add = getIPAddress();
                                                if (isset($_POST['update_cart'])) {
                                                    $quantities = $_POST['qty'];
                                                    $quantity_string = implode(", ", $quantities); // Convert array to comma-separated string
                                                    $update_cart = "UPDATE `cart_details` SET quantity='$quantity_string' WHERE ip_address='$get_ip_add'";
                                                    $result_products_quantity = mysqli_query($con, $update_cart);
                                                }
                                                ?>
                                                <?php echo $tasker_values ?>
                                            </td>
                                            <td><input type="checkbox" name="removeitem[]" value="<?php echo $tasker_id ?>"></td>
                                            <td>

                                                
                                                <input type="submit" value="Sterge" class="bg-info p-3 py-2 border-0 mx-3"
                                                    name="remove_cart">

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } else {
                                echo "<h2 class='text-center text-danger'>Cosul este gol</h2>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!--subtotal-->
                    <div class="d-flex mb-5">
                        <?php
                        global $con;
                        $get_ip_add = getIPAddress();
                        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo "<h4 class='px-3'>Subtotal:<strong class='text-info'>$total_price</strong></h4>
                            <input type='submit' value='Mai cauta' class='bg-info p-3 py-2 border-0 mx-3'
                            name='continue_shopping'>
                                    <button class='bg-secondary p-3 py-2 border-0 text-light'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Finalizeaza</button></a>";
                        } else {
                            echo " <input type='submit' value='Continue Shopping' class='bg-info p-3 py-2 border-0 mx-3' name='continue_shopping'>";
                        }
                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        ?>
                    </div>
            </div>
        </div>
        </form>
        <!--function to remove-->
        <?php
        function remove_cart_item()
        {
            global $con;
            if (isset($_POST['remove_cart'])) {
                foreach ($_POST['removeitem'] as $remove_id) {
                    echo $remove_id;
                    $delete_query = "DELETE FROM `cart_details` WHERE ID_Vanzator='$remove_id'";
                    $run_delete = mysqli_query($con, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }

        remove_cart_item();


        ?>

        <?php include("./includes/footer.php");
        ?>
    </div>








    <!--bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>
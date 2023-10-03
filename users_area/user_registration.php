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
    <title>Inregistrare</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center">Inregistrare utilizator nou</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!--username field-->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Introdu un username"
                            autocomplete="off" required="required" name="user_username">
                    </div>
                    <!--Email field-->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Introdu un email"
                            autocomplete="off" required="required" name="user_email">
                    </div>
                    <!--User IMG-->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">Imagine</label>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image">
                    </div>
                    <!--password field-->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Parola</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Introdu o parola"
                            autocomplete="off" required="required" name="user_password">
                    </div>
                    <!--Email field-->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirmare Parola</label>
                        <input type="password" id="conf_user_password" class="form-control"
                            placeholder="Confirma parola" autocomplete="off" required="required"
                            name="conf_user_password">
                    </div>
                    <!--Address field-->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Adresa</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Introdu o adresa"
                            autocomplete="off" required="required" name="user_address">
                    </div>
                    <!--Contact field-->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control"
                            placeholder="Introdu numarul de telefon" autocomplete="off" required="required"
                            name="user_contact">
                    </div>
                    <div class="text-center mt-4 pt-2">
                        <input type="submit" value="Finalizare" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1">Ai dejo cont? <a href="user_login.php" class="text-danger">
                                LOGARE</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>


<!-- php -->
<?php
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    // Select query
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        echo "<script>alert('Utilizatorul sau adresa de mail deja exista')</script>";
    } else if ($user_password != $conf_user_password) {
        echo "<script>alert('Parola de verificare diferita')</script>";
    } else {
        // Insert query
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            echo "<script>alert('Inregistrat cu succes')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
    // SELECTING CART ITEMS
    $select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $result_cart = mysqli_query($con, $select_cart_items);
    $row_count = mysqli_num_rows($result_cart);
    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('Ai taskers in cos')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
?>
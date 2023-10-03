<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
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
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center">Logare</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">
                    <!--username field-->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Introdu un username"
                            autocomplete="off" required="required" name="user_username">
                    </div>
                    <!--password field-->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Parola</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Introdu o parola"
                            autocomplete="off" required="required" name="user_password">
                    </div>
                    <div class="text-center mt-4 pt-2">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1">Nu ai cont? <a href="user_registration.php"
                                class="text-danger"> Inregistreazate</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    // Cart item
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart = mysqli_query($con, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);
    
    if ($row_data !== null && password_verify($user_password, $row_data['user_password'])) {
        if ($row_count_cart > 0) {
            if ($row_count == 1) {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Logare cu succes')</script>";
                echo "<script>window.open('../index.php','_self')</script>";
            } else {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Logare cu succes')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            $_SESSION['username'] = $user_username;
            echo "<script>alert('Cosul este gol')</script>";
            echo "<script>window.open('../index.php','_self')</script>";
        }
    } else {
        echo "<script>alert('Date incorecte')</script>";
    }
}

?>



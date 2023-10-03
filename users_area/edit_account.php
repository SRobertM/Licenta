<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $username = isset($_POST['user_username']) ? $_POST['user_username'] : "username";
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_mobile'];
}

if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $new_username = isset($_POST['user_username']) ? $_POST['user_username'] : "";
    $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : "";
    $user_address = isset($_POST['user_address']) ? $_POST['user_address'] : "";
    $user_mobile = isset($_POST['user_mobile']) ? $_POST['user_mobile'] : "";
    $user_image = isset($_FILES['user_image']['name']) ? $_FILES['user_image']['name'] : "";
    $user_image_tmp = $_FILES['user_image']['tmp_name'];

    // Check if an image is uploaded
    if (!empty($user_image)) {
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        // Update query
        $update_data = "UPDATE `user_table` SET username='$new_username', user_email='$user_email', user_image='$user_image', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
        $result_query_update = mysqli_query($con, $update_data);

        // Check if the query executed successfully and at least one row was affected
        if ($result_query_update && mysqli_affected_rows($con) > 0) {
            // Update the username in the session
            $_SESSION['username'] = $new_username;
            echo "<script>alert('Actualizat cu succes')</script>";
            echo "<script>window.location.reload();</script>"; // Reload the page
        }
    } else {
        // Update query without the image
        $update_data = "UPDATE `user_table` SET username='$new_username', user_email='$user_email', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
        $result_query_update = mysqli_query($con, $update_data);

        // Check if the query executed successfully and at least one row was affected
        if ($result_query_update && mysqli_affected_rows($con) > 0) {
            // Update the username in the session
            $_SESSION['username'] = $new_username;
            echo "<script>alert('Actualizat cu succes')</script>";
            echo "<script>window.location.reload();</script>"; // Reload the page
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit_account</title>
</head>

<body>
    <h3 class="text-center text-success mb-4">Modifica datele contului</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
    <div class="form-outline mb-4">
    <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="user_username">
</div>

        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email">
        </div>
        <div class="form-outline mb-4">
            <input type="file" class="form-control w-50 m-auto" name="user_image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile ?>" name="user_mobile">
        </div>
        <input type="submit" value="Actualizeaza" class="bg-info py-2 px-3 border-0" name="user_update">
    </form>
</body>

</html>
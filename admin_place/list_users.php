<h3 class="text-center text-success">Toti utilizatorii</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
    <?php
    $get_orders = "SELECT * FROM `user_table`";
    $result = mysqli_query($con, $get_orders);
    $row_count = mysqli_num_rows($result);
    echo "
    <tr>
        <th>ID utilizator</th>
        <th>Utilizator</th>
        <th>Email</th>
        <th>Imagine</th>
        <th>Adresa</th>
        <th>Telefon</th>
        
    </tr>
    </thead>
    <tbody class='bg-secondary text-light'>";
    
    if ($row_count == 0) {
        echo "<h2 class='bg-danger text-center mt-5'>Fara utilizatori</h2>";
    } else {
        $number = 0;
        while ($row_data = mysqli_fetch_assoc($result)) {
            $user_id = $row_data['user_id'];
            $username = $row_data['username'];
            $user_email = $row_data['user_email'];
            $user_image = $row_data['user_image'];
            $user_address = $row_data['user_address'];
            $user_mobile = $row_data['user_mobile'];
            $number++;
            echo "
            <tr>
                <td>$number</td>
                <td>$username</td>
                <td>$user_email</td>
                <td><img src='../users_area/user_images/$user_image' alt='$username' class='product_img'/></td>
                <td>$user_address</td>
                <td>$user_mobile</td>
                
            </tr>";
        }
    }
    ?>
</tbody>
</table>


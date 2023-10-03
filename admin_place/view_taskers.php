<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskers</title>
</head>

<body>
    <h3 class="text-center text-success">Toti taskers</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>Id Tasker</th>
                <th>Nume</th>
                <th>Imagine</th>
                <th>Pret</th>
                <th>Total contracte efectuate</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Sterge</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">

            <?php
            $get_products = "SELECT * FROM `vanzatori`";
            $result = mysqli_query($con, $get_products);
            $number = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['ID_Vanzator'];
                $product_title = $row['Nume_Vanzator'];
                $product_image1 = $row['tasker_image1'];
                $product_price = $row['Pret'];
                $status = $row['status'];
                $number++;
                ?>
                <tr class="text-center">
                    <td>
                        <?php echo $number; ?>
                    </td>
                    <td>
                        <?php echo $product_title; ?>
                    </td>
                    <td><img src="../images/<?php echo $product_image1; ?>" class="product_img" /></td>
                    <td>
                        <?php echo $product_price; ?>
                    </td>
                    <td>
                        <?php
                        $get_count = "SELECT * FROM `order_taskers` WHERE ID_Vanzator=$product_id";
                        $result_count = mysqli_query($con, $get_count);
                        $rows_count = mysqli_num_rows($result_count);
                        echo $rows_count;
                        ?>
                    </td>


                    <td>
                        <?php echo $status; ?>
                    </td>
                    <td><a href="index.php?edit_taskers=<?php echo $product_id ?>" class="text-light"><i
                                class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href="index.php?delete_tasker=<?php echo $product_id ?>" class="text-light"><i
                                class="fa-solid fa-trash"></i></a></td>
                </tr>
                <?php
            }
            ?>

        </tbody>

    </table>

</body>

</html>
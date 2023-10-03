<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>ID</th>
            <th>Nume categorie</th>
            <th>Edit</th>
            <th>Sterge</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $select_cat = "SELECT * FROM `categorii`"; 
        $result = mysqli_query($con, $select_cat);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $category_id = $row['ID_Categorie'];
            $category_title = $row['Nume_Categorie'];
            $number++;
        ?>
        <tr class="text-center">
            <td><?php echo $number ?></td>
            <td><?php echo $category_title ?></td>
            </td>
            <td><a href="index.php?edit_categories=<?php echo $category_id?>" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>
            <td><a href="index.php?delete_categories=<?php echo $category_id?>" class="text-light"><i class="fa-solid fa-trash"></i></a></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
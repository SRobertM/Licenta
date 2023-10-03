<h3 class="text-center text-success">Toate locatiile</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>ID</th>
            <th>Nume Locatie</th>
            <th>Edit</th>
            <th>Sterge</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $select_cat = "SELECT * FROM `locatie`"; 
        $result = mysqli_query($con, $select_cat);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $location_id = $row['ID_Locatie'];
            $location_title = $row['Nume_Locatie'];
            $number++;
        ?>
        <tr class="text-center">
            <td><?php echo $number ?></td>
            <td><?php echo $location_title ?></td>
            </td><td><a href="index.php?edit_locations=<?php echo $location_id ?>" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>
            <td><a href="index.php?delete_locations=<?php echo $location_id ?>" class="text-light"><i class="fa-solid fa-trash"></i></a></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<h1 class="text-center text-success bg-info">All Brands</h1>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">
        <tr class="bg-info">
            <th class="bg-info">list no.</th>
            <th class="bg-info">Brand Title</th>
            <th class="bg-info">Edit</th>
            <th class="bg-info">Delete</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $select_brand = "SELECT * FROM `brand`";
        $result = mysqli_query($con, $select_brand);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $brand_id = $row['brand_id'];
            $brand_title = $row['brand_title'];
            $number++;

        ?>
            <tr>
                <td><?php echo $number ?></td>
                <td><?php echo $brand_title ?></td>
                <td><a href='index.php?edit_brand=<?php echo $brand_id ?>' class='text-secondary'><i class='fa-solid fa-pen-to-square'></i></td>
                <td><a href='index.php?delete_brand=<?php echo $brand_id ?>' class='text-secondary'><i class='fa-solid fa-trash'></i></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
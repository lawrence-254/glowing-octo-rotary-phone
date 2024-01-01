<h1 class="text-center text-success bg-info">All Categories</h1>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">
        <tr class="bg-info">
            <th class="bg-info">list no.</th>
            <th class="bg-info">Category Title</th>
            <th class="bg-info">Edit</th>
            <th class="bg-info">Delete</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $select_cat = "SELECT * FROM `category`";
        $result = mysqli_query($con, $select_cat);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $cat_id = $row['category_id'];
            $cat_title = $row['category_title'];
            $number++;

        ?>
            <tr>
                <td><?php echo $number ?></td>
                <td><?php echo $cat_title ?></td>
                <td><a href='index.php?edit_cat=<?php echo $cat_id ?>' class='text-secondary'><i class='fa-solid fa-pen-to-square'></i></td>
                <td><a href='index.php?delete_cat=<?php echo $cat_id ?>' class='text-secondary'><i class='fa-solid fa-trash'></i></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
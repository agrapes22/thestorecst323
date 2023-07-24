<form action="#" method="post">
    <div class="form-group">
        <?Php
        if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];

            //find all categories query
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $select_categories_id = mysqli_query($connection, $query);
            //While loop
            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>
                <input value="<?php if (isset($cat_title)) {
                    echo $cat_title;
                } ?>" type="text" class="form-control" name="cat_title">
            <?php }
        } ?>

        <?php
        //Update query
        if (isset($_POST['cat_title'])) {
            $the_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";
            $update_query = mysqli_query($connection, $query);
            if (!$update_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
            header('location: ' . $_SERVER['PHP_SELF']);
        }
        ?>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update Category</button>
    </div>

</form>
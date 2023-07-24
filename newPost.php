<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<style>
    [type=radio] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    [type=radio]+img {
        cursor: pointer;
        width: 150px;
        height: 150px;
        padding: 5px;
    }

    /* CHECKED STYLES */
    [type=radio]:checked+img {
        outline: 2px solid #f00;
    }
</style>

<!DOCTYPE html>
<html lang="en">

    <body>

        <!-- Navigation -->
        <?php
        include "includes/navigation.php";
        $writeLog->writeLog("Entered newPost.php", "load-page", "newPost.php", "INFO");
        ?>

        <div class="container">

            <?php $post_title = $_POST['course'] ?>
            <h2>Title: <?php echo $post_title ?></h2>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content'])) {
                $writeLog->writeLog("Now starting POST of new post form", "form-post", "newPost.php", "INFO");
                $content = $_POST["content"];
                $author = $_POST["author"];
                $date = date("m/d/y");
                $post_date = date("Y-m-d", strtotime($date));
                $category_id = $_POST["cat_id"];
                $tags = $_POST["tags"];
                $picture = $_POST["picture"];
                $title = $_POST["post_title"];

                $sqlquery = "INSERT INTO posts (post_content, post_author, post_date, post_category_id, post_tags, post_image, post_title, post_status) 
                    VALUES ('$content', '$author', '$post_date', $category_id, '$tags', '$picture', '$title', 'Active')";

                $insertQuery = mysqli_query($connection, $sqlquery);

                if (!$insertQuery) {
                    $writeLog->writeLog("Query FAILED " . mysqli_error($connection), "form-post", "newPost.php", "ERROR");
                } else {
                    $new_id = $connection->insert_id;
                    header('location: post.php?id=' . $post_id);
                }
                exit;
            }
            ?>

            <div class="well">
                <h4>Create a new post:</h4>
                <form method="post" action="#" role="form">
                    <div class="form-group">
                        <input name="author" type="text" class="form-control" placeholder="Author">
                    </div>
                    <div class="form-group">
                        <select name="cat_id" id="cat_id">
                            <option disabled selected>Category</option>
                            <?php
                            $writeLog->writeLog("Selecting categories from database", "form-select", "newPost.php", "INFO");

                            $query = "SELECT * FROM categories";
                            $select_all_posts_query = mysqli_query($connection, $query);

                            $writeLog->writeLog("Categories:", "form-select", "newPost.php", "DEBUG");
                            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                                $writeLog->writeLog($cat_id . " " . $cat_title, "form-select", "newPost.php", "DEBUG");
                                ?>
                                <option name="cat_id" id="cat_id" value=<?php echo $cat_id; ?>><?php echo $cat_title; ?>
                                </option>
                                <!--turn back php on to close the loop-->
                                <?php
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" id="content" name="content"
                            placeholder="Post content"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="tags" id="tags" placeholder="Post Tags" class="form-control">
                    </div>
                    <div class="form-group">
                        <p>Please select a picture for your post:</p>
                        <?php
                        $writeLog->writeLog("Retrieving images for selection from images/*.png", "form-select", "newPost.php", "INFO");
                        $files = glob("images/*.png");
                        foreach ($files as $img => $value) {
                            ?>
                            <label>
                                <input type="radio" name="picture" value="<?php echo str_replace('images/', '', $value) ?>"
                                    checked>
                                <img src="<?php echo $value ?>" alt="<?php echo str_replace('images/', '', $value) ?>">
                            </label>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $post_title ?>" name="post_title" id="post_title">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>

        <hr>

        <!-- Footer -->
        <?php
        include "includes/footer.php";
        ?>

    </body>

</html>
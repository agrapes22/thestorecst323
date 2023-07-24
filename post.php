<!DOCTYPE html>
<html lang="en">
    <?php require("includes/db.php"); ?>
    <?php include "includes/header.php"; ?>
    <?php include "includes/navigation.php"; ?>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <?php
        $writeLog->writeLog("Selecting post from database", "page-select", "post.php", "INFO");

        $id = $_GET['id'];
        $query = "SELECT * FROM posts WHERE post_id = " . $id;
        $select_all_posts_query = mysqli_query($connection, $query);
        if (!$select_all_posts_query) {
            $writeLog->writeLog("QUERY FAILED " . mysqli_error($connection), "page-select", "post.php", "ERROR");
        } else {
            $row = mysqli_fetch_assoc($select_all_posts_query);
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_title = $row['post_title'];
            $post_content = $row['post_content'];
        }
        ?>

        <title><?php echo $post_title ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/blog-post.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    </head>

    <body>

        <!-- Navigation -->

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <!-- Blog Post Content Column -->
                <div class="col-lg-8">

                    <!-- Blog Post -->

                    <!-- Title -->
                    <h1><?php echo $post_title ?></h1>

                    <!-- Author -->
                    <p class="lead">
                        by <a href="#"><?php echo $post_author ?></a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>

                    <hr>

                    <!-- Preview Image -->
                    <!-- <img class="img-responsive" src="images".<?php $post_image ?> alt=""> -->
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                    <hr>

                    <!-- Post Content -->
                    <p><?php echo $post_content ?></p>

                    <hr>

                    <!-- Blog Comments -->

                    <!-- Comments Form -->
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['comment'])) {
                            $comment = $_POST["comment"];
                            $author = "Adriel Swisher";
                            $date = date("m/d/y");
                            $comment_date = date("Y-m-d", strtotime($date));
                            $comment_post_id = $post_id;

                            $sqlquery = "INSERT INTO comments (post_id, comment_author, comment_date, comment_content) 
                            VALUES ($comment_post_id, '$author', '$comment_date', '$comment')";

                            $connection->query($sqlquery);
                            unset($_POST["comment"]);
                            header('location: ' . $_SERVER['PHP_SELF'] . "?id=" . $post_id);
                            exit;
                        }
                    }
                    ?>

                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form method="post" action="" role="form">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <hr>

                    <!-- Posted Comments -->

                    <?php
                    $writeLog->writeLog("Selecting comments from database", "page-select", "post.php", "INFO");
                    $query = "SELECT * FROM comments WHERE post_id = " . $post_id;
                    $select_all_posts_query = mysqli_query($connection, $query);
                    if (!$mysqli_query) {
                        $writeLog->writeLog("QUERY FAILED " . mysqli_error($connection), "page-select", "post.php", "ERROR");
                    } else {
                        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $comment_content = $row['comment_content'];
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            ?>

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $comment_author; ?>
                                        <?php echo "<small>" . $comment_date . "</small>"; ?>
                                    </h4>
                                    <?php echo $comment_content ?>
                                </div>
                            </div>
                            <!--turn back php on to close the loop-->
                            <?php
                        }
                    } ?>
                </div>

                <hr>

                <!-- Blog Sidebar Widgets Column -->
                <?php
                include "includes/sidebar.php";
                ?>

            </div>
            <!-- /.row -->

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; Your Website 2014</p>
                    </div>
                </div>
                <!-- /.row -->
            </footer>

        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
<?php include "includes/header.php"; ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include
            "includes/navigation.php";
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome!
                            <small>To My Academic Journey</small>
                        </h1>

                        <div class="col-sm-6">
                            <?php
                            if (isset($_POST['submit'])) {
                                $cat_title = $_POST['cat_title'];

                                if ($cat_title == "" || empty($cat_title)) {
                                    echo "This field should not be empty";
                                } else {
                                    $query = "INSERT INTO categories(cat_title)";
                                    $query .= "VALUE('{$cat_title}')";

                                    $create_category_query = mysqli_query($connection, $query);
                                    if (!$create_category_query) {
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                }
                                header('location: ' . $_SERVER['PHP_SELF']);
                            } else if (isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];
                                include "includes/update_categories.php";
                            } else {

                                ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="cat-title">Add Category</label>
                                            <input type="text" class="form-control" name="cat_title">
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                        </div>
                                    </form>
                                <?php } ?>
                        </div>

                        <div class="col-sm-6">
                            <table class="table table-bordered table-hover">
                                <thread>
                                    <tr>
                                        <th>Id</th>
                                        <th>Course Title</th>
                                        </>
                                    </tr>
                                </thread>
                                <tbody>

                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $select_categories = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($select_categories)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];

                                        echo "<td>{$cat_id}</td>";
                                        echo "<td>{$cat_title}</td>"; //this allows me to delete added categories
                                        echo "<td><a href='categories.php?delete={$cat_id}' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a></td>";
                                        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                    <?php
                                    //Delete query
                                    if (isset($_GET['delete'])) {
                                        $the_cat_id = $_GET['delete'];
                                        $query = "DELETE FROM categories WHERE cat_id ={$the_cat_id}";
                                        $delete_query = mysqli_query($connection, $query);
                                        header("Location: categories.php");
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
    include "includes/footer.php";
    ?>
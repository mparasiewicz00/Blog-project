<?php include "includes/admin_header.php"?>

    <body>

<div id="wrapper">

<?php include "includes/admin_navigation.php"?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome
                        <small>Author</small>
                    </h1>

                    <div class="col-xs-6">

                    <?php
                    if(isset($_POST['submit'])) {

                      $cat_title = $_POST['cat_title'];

                      if($cat_title == "" || empty($cat_title)){
                          echo "This field shouldn't be empty";
                      } else {
                          global $connection;
                          $query = "INSERT INTO categories(cat_title) ";
                          $query .= "VALUE('{$cat_title}') ";

                          $create_category_query = mysqli_query($connection, $query) ;

                          if(!$create_category_query){
                              die('QUERY FAILED'. mysqli_error($connection));
                          }
                      }

                    }

                    ?>



                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cat-title">Add category</label>
                            <input class="form-control" type="text" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                        </div>


                    </form>
                    </div>
                </div>

                <div class="col-xs-6">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Title</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php // FIND ALL CATEGORIES QUERY
                        global $connection;
                        $query = "SELECT * FROM categories";
                        $select_categories= mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_categories)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<tr>";
                            echo "<td>{$cat_id}</td>";
                            echo "<td>{$cat_title}</td>";
                            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                            echo "</tr>";
                        }
                        ?>

                        <?php
                        if(isset($_GET['delete'])){
                           $the_cat_id = $_GET['delete'];
                           $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                           $delete_query = mysqli_query($connection, $query);
                           header("Location: categories.php");
                        }



                        ?>


                        </tbody>
                    </table>



                </div>


            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>

<?php include "includes/admin_footer.php"; ?>
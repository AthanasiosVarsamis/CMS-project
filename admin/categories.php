<?php include "includes/admin_header.php"; ?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>

                    <div class="col-xs-6">

                        <?php
                       instert_categories();



                        ?>

                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Add Category" name="submit">

                            </div>
                        </form>

                        <?php // UPDATE AND INCLUDE QUERY
                        if(isset($_GET['edit'])){
                            $cat_id =$_GET['edit'];
                            include "includes/update_categories.php";

                        }
                            ?>
                       <div class="class-xs-6">
                          <table class="table table-bordered table-hover">
                              <thead>
                                 <tr>
                                     <th>Id</th>
                                      <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php //find all categories query
                              findAllCategories();
                          
                              ?>
                              <?php //DELETE CATEGORY QUERY
                              deleteCategories();
                              ?>
                          
                           </tbody>
                         </table>
                        </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>

    </div> <!-- Add category form-->

    <div class="col-xs-6">

        <?php

        // if (isset($_POST['delete'])) {
        //     $cat_id = $_POST['cat_id'];

        //     if ($cat_id == "" || empty($cat_id)) {
        //         echo "this shoudnd be empty";
        //     } else {

        //         $query_delete = "DELETE FROM categories WHERE cat_id={$cat_id}";
        //         $delete_category_query = mysqli_query($connection, $query_delete);

        //         if (!$delete_category_query) {
        //             die("query failed" . mysqli_error($connection));
        //         }
        //     }
        // }


        ?>

        <!-- <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-id">Delete Category</label>
                                <input type="text" class="form-control" name="cat_id">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Delete Category" name="delete">
                            </div>
                        </form> -->

    </div> <!-- DELETE category form-->

    <?php include "includes/admin_footer.php"; ?>
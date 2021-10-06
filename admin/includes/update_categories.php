<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>

        <?php
        //get all categories from database

        if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];

            $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
            $select_categories_query = mysqli_query($connection, $query);
            //return pulled data
            while ($row = mysqli_fetch_assoc($select_categories_query)) {
                $cat_id =  $row['cat_id'];
                $cat_title =  $row['cat_title'];

        ?>


                <!--Make the value from the db appear-->
                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                }  ?>" class="form-control" type="text" name="cat_title">


        <?php  }
        } ?>

        <?php

        //UPDATE Category 
        if (isset($_POST['update_category'])) {

        
            // UPDATE category QUERY
            $the_cat_title =mysqli_real_escape_string($connection,$_POST['cat_title']);
            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";
            $update_query = mysqli_query($connection, $query);

            if (!$update_query) {

                die("QUERY Failed!" . mysqli_error($connection));
            }
        }

        ?>



    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>
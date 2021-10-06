<?php


if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}



$query = "SELECT * FROM posts WHERE post_id = $the_post_id";

$select_post_by_id = mysqli_query($connection, $query);

confirmQuery($select_post_by_id);

while ($row = mysqli_fetch_assoc($select_post_by_id)) {
    $post_id = $row['post_id'];
    $post_user_id = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
}
if (isset($_POST['update_post'])) {



    $post_title = $_POST['post_title'];
    $post_user = $_POST['post_user'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    foreach ($_POST as $field => $value) {
        $_POST[$field] = mysqli_real_escape_string($connection, $value);
    }
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }


  


    $query = "UPDATE posts SET "; // -> You need whitespace after SET
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = {$post_category_id}, "; // -> Quotes are not needed with int values
    $query .= "post_date = now(), ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";

    $update_post = mysqli_query($connection, $query);

    confirmQuery($update_post);

    echo "<p class='bg-success'>Post Updated <a href='../post.php?p_id={$the_post_id}'>View Post</a>  </p>" . "<a href='posts.php'>Edit More Posts</a> ";
}

?>



<form action="" method="post" enctype="multipart/form-data">
    <!-- enctype Defines the content type of the form data when the method is POST. -->
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>


    <div class="form-group">
        <select name="post_category" id="post_category">
            <?php
            $query = "SELECT * FROM categories ";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);
            //return pulled data
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id =  $row['cat_id'];
                $cat_title =  $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <select name="post_user" id="post_user">
            <label for="users">Users</label>
            <?php 
            $user = "SELECT * FROM users WHERE user_id = $post_user_id ";
            $user_query=mysqli_query($connection,$user);
            confirmQuery($user_query);
            while( $user_row=mysqli_fetch_assoc($user_query)){
            $post_user=$user_row['username'];
            }
            echo   "<option value='$post_user'> $post_user</option>";
            ?>
          
            <?php
            $query = "SELECT * FROM users ";
            $users_query = mysqli_query($connection, $query);
            confirmQuery($users_query);
            while ($row = mysqli_fetch_assoc($users_query)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo  "<option value='{$user_id}'>${username}</option>";
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <!-- adding dyniamic categories -->
        <select name="post_status" id="post_status">
            <option value=<?php echo $post_status; ?>><?php echo $post_status; ?></option>";
            <?php


            if ($post_status == 'published') {
                echo "<option value='draft'>draft</option>";
            } else {
                echo "<option value='published'>published</option>";
            }
            ?>

        </select>

    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <br>
        <img src="../images/<?php echo $post_image; ?>" width="100" alt="">
        <input type="file" name="post_image">

    </div>


    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class=" form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn_primary" name="update_post" value="UPDATE">
    </div>

</form>
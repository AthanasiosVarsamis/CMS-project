<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_user = $_POST['post_user'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

   


    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    //$post_comment_count = 4;

    foreach ($_POST as $field => $value) {
        $_POST[$field] = mysqli_real_escape_string($connection, $value);
    }
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    move_uploaded_file($post_image_temp, "../images/$post_image");


    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_status) ";
    $query .= "VALUES({$post_category_id},'{$post_title}', {$post_user},now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}' ) ";

    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);

    $the_post_id=mysqli_insert_id($connection); //the last created id on that table

    echo "<p class='bg-success'>Post has been created <a href='../post.php?p_id={$the_post_id}'>View Post</a>  </p>" . "<a href='posts.php'>Add More Posts</a> ";
}

?>




<form action="" method="post" enctype="multipart/form-data">
    <!-- enctype Defines the content type of the form data when the method is POST. -->
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
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
            <option value="">USERS</option>
            <?php
            $query ="SELECT * FROM users ";
            $users_query =mysqli_query($connection,$query);
            confirmQuery($users_query);
            while($row=mysqli_fetch_assoc($users_query)){
                $user_id=$row['user_id'];
                $username =$row['username'];
                echo  "<option value='{$user_id}'>${username}</option>";
            }
            ?>
            
        </select>
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="draft">Draft</option>
            <option value="published">Publish</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn_primary" name="create_post">
    </div>

</form>
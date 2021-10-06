<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk-options'];
        switch ($bulk_options) {
            case  'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $publish_query = mysqli_query($connection, $query);
                confirmQuery($publish_query);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status ='{$bulk_options}' ";
                $query .= "WHERE post_id = {$postValueId}";
                $draft_query = mysqli_query($connection, $query);
                confirmQuery($draft_query);

                break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $delete_query = mysqli_query($connection, $query);
                confirmQuery($delete_query);
                break;
            case 'clone' :
                $query ="SELECT * FROM posts WHERE post_id='{$postValueId}' ";
                $select_post_query=mysqli_query($connection,$query);
                confirmQuery($select_post_query);

                while($row=mysqli_fetch_assoc($select_post_query)){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
                $post_date = $row['post_date'];
            }



                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";
                $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}' ) ";

                $copy_post_query = mysqli_query($connection, $query);

                confirmQuery($copy_post_query);
                break;
            default:
                echo "YOU DIDNT  SELECT AN OPTION";
                break;
        }
    }
}
?>


<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div class="row">
            <div id="bulkOptionContainer" class="col-xs-4">
                <select name="bulk-options" id="" class="form-control">
                    <option value="">Select Options</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" class="btn btn-success" name="submit" value="Apply">
                <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
            </div>
        </div>


        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Views</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM posts ORDER BY post_id DESC ";
            $select_post = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_post)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user_id =$row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];

                echo "<tr>";
            ?>
                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
            <?php
                echo "<td>{$post_id}</td>";
                if($post_user_id!=NULL || $post_user_id != ""){
                $user = "SELECT * FROM users WHERE user_id = $post_user_id ";
                $user_query=mysqli_query($connection,$user);
                confirmQuery($user_query);
                while( $user_row=mysqli_fetch_assoc($user_query)){               
                $post_user=$user_row['username'];
                }
               }

                if(!empty($post_author)){
                echo "<td>{$post_author}</td>";
                }elseif(!empty($post_user)){
                    echo "<td>{$post_user}</td>";

                }

                echo "<td>{$post_title}</td>";

                $category_query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";

                $select_categories_id = mysqli_query($connection, $category_query);

                confirmQuery($select_categories_id);
                while ($cat_row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = $cat_row['cat_id'];
                    $cat_title = $cat_row['cat_title'];
                    echo "<td>${cat_title}</td>";
                }

                // echo "<td>{$post_category_id}</td>";



                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/{$post_image}'></td>";
                echo "<td>{$post_tags}</td>";


                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($connection, $query);
                

               
                $count_comments = mysqli_num_rows($send_comment_query);
                if($count_comments>0){
                $row = mysqli_fetch_array($send_comment_query);
                $comment_id = $row['comment_id'];


                echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
                }else{
                    echo "<td><a href='post_comments.php?id=$post_id'>$post_comment_count</a></td>";
                }
             
                echo "<td><a href='#'>{$count_comments}<a></td>";
                echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='posts.php?delete={$post_id}'>Delete</a></td>";

                echo "</tr>";
            }


            ?>

            <?php
            if(isset($_GET['reset'])){
                $the_post_id=$_GET['reset'];
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =$the_post_id ";
                $reset_views_query = mysqli_query($connection,$query);
                confirmQuery($reset_views_query);
                header("Location: posts.php");
            }

            if (isset($_GET['delete'])) {
                $the_post_id = $_GET['delete'];
                $query = "DELETE FROM posts WHERE post_id ={$the_post_id} ";
                $delete_query = mysqli_query($connection, $query);

                confirmQuery($delete_query);
                header("Location: posts.php");
            }

            ?>

        </tbody>
    </table>
</form>
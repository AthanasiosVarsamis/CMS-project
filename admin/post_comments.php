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
                        Welcome to admin
                        <small>Author</small>
                    </h1>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comments</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response to</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $_GET['id']) . " ";
                            $select_comment = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_comment)) {
                                $comment_id = $row['comment_id'];
                                $comment_post_id = $row['comment_post_id'];
                                $comment_author = $row['comment_author'];
                                $comment_content = $row['comment_content'];
                                $comment_email = $row['comment_email'];
                                $comment_status = $row['comment_status'];
                                $comment_date = $row['comment_date'];

                                echo "<tr>";
                                echo "<td>{$comment_id}</td>";
                                echo "<td>{$comment_author}</td>";
                                echo "<td>{$comment_content}</td>";

                                // $category_query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";

                                // $select_categories_id = mysqli_query($connection, $category_query);

                                // confirmQuery($select_categories_id);
                                // while ($cat_row = mysqli_fetch_assoc($select_categories_id)) {
                                //     $cat_id = $cat_row['cat_id'];
                                //     $cat_title = $cat_row['cat_title'];
                                //     echo "<td>${cat_title}</td>";
                                // }

                                // echo "<td>{$post_category_id}</td>";
                                echo "<td>{$comment_email}</td>";
                                echo "<td>{$comment_status}</td>";


                                $query = "SELECT * FROM posts WHERE post_id =$comment_post_id ";
                                $select_post_id_query = mysqli_query($connection, $query);

                                confirmQuery($select_post_id_query);

                                while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];
                                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                }
                                echo "<td>{$comment_date}</td>";

                                echo "<td><a href='post_comments.php?approve={$comment_id}&id=".$_GET['id']."'>Approve</a></td>";
                                echo "<td><a href='post_comments.php?unapprove={$comment_id}&id=" . $_GET['id'] . "'>Unapprove</a></td>";
                                echo "<td><a href='post_comments.php?delete={$comment_id}&id=" . $_GET['id'] . "'>Delete</a></td>";
                                echo "</tr>";
                            }


                            ?>
                            <?php
                            if (isset($_GET['approve'])) {
                                $the_comments_id = $_GET['approve'];
                                $query = " UPDATE comments SET  comment_status = 'approved'  WHERE comment_id ={$the_comments_id}  ";
                                $unapprove_comment_query = mysqli_query($connection, $query);
                                confirmQuery($unapprove_comment_query);
                                header("Location: post_comments.php?id=".$_GET['id']."");
                            }

                            ?>
                            <?php
                            if (isset($_GET['unapprove'])) {
                                $the_comments_id = $_GET['unapprove'];
                                $query = " UPDATE comments SET  comment_status = 'unapproved' WHERE comment_id ={$the_comments_id} ";
                                $unapprove_comment_query = mysqli_query($connection, $query);
                                confirmQuery($unapprove_comment_query);
                                header("Location: post_comments.php?id=" . $_GET['id'] . "");                            }

                            ?>



                            <?php
                            if (isset($_GET['delete'])) {
                                $the_comments_id = $_GET['delete'];
                                $query = " DELETE FROM comments WHERE comment_id ={$the_comments_id} ";
                                $delete_comment_query = mysqli_query($connection, $query);
                                confirmQuery($delete_comment_query);
                                header("Location: post_comments.php?id=" . $_GET['id'] . "");                            }


                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>

</div> <!-- Add category form-->

<div class="col-xs-6">




</div> <!-- DELETE category form-->

<?php include "includes/admin_footer.php"; ?>
<?php include "includes/admin_header.php"; ?>
<?php
if (isset($_SESSION['username'])) {
    $username =$_SESSION['username'];
    $query="SELECT * FROM users where username = '${username}' ";
    $select_user_profile_query = mysqli_query($connection,$query);
    confirmQuery($select_user_profile_query);
    while($row=mysqli_fetch_assoc($select_user_profile_query)){
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];

        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
    }
    
}

?>

<?php
if(isset($_POST['edit_profile'])){

    $ed_user_firstname = $_POST['user_firstname'];
    $ed_user_lastname = $_POST['user_lastname'];
    $ed_username = $_POST['username'];
    $ed_user_email = $_POST['user_email'];
    $ed_user_password = $_POST['user_password'];


    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$ed_user_firstname}', ";
    $query .= "user_lastname = '{$ed_user_lastname}', ";
    $query .= "username = '{$ed_username}', ";
    $query .= "user_email = '{$ed_user_email}', ";
    $query .= "user_password = '{$ed_user_password}' ";
    $query .= "WHERE username = '{$ed_username}' ";
    
    $update_profile_query = mysqli_query($connection,$query);
    confirmQuery($update_profile_query);

}

?>


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

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="firstname"> Firstname </label>
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
                        </div>

                        <div class="form-group">
                            <label for="author"> Lastname</label>
                            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
                        </div>


                        <!-- <div class="form-group">
        <label for="title"> Post Image </label>
        <input type="file" class="form-control" name="post_image">
    </div> -->


                        <div class="form-group">
                            <label for="user"> Username </label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email"> e-mail </label>
                            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_password"> Password </label>
                            <input  type="password" class="form-control" name="user_password" autocomplete="off">
                        </div>


                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_profile" value="Update Profile">
                        </div>
                    </form>

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
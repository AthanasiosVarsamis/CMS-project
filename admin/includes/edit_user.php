<?php //displaying
if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];


$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
$slect_user_query = mysqli_query($connection, $query);

confirmQuery($slect_user_query);

while ($row = mysqli_fetch_assoc($slect_user_query)) {
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $username = $row['username'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
    
}

?>
<?php //editing
if (isset($_POST['update'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    if(!empty($user_password)){
        $query_password ="SELECT user_password FROM users WHERE user_id = $the_user_id";

        $get_user= mysqli_query($connection,$query_password);
        confirmQuery($get_user);
        $row =mysqli_fetch_array($get_user);
        $db_user_password = $row['user_password'];
    }
    if($db_user_password != $user_password){
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
    }

    foreach($_POST as $field =>$value){
        $_POST[$field]=mysqli_real_escape_string($connection,$value);
    }
    

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$hashed_password}' ";
    $query .= "WHERE user_id = {$the_user_id} ";

    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
 } 
}else{
    header("Location: index.php");
}


?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="firstname"> Firstname </label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>

    <div class="form-group">
        <label for="author"> Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

            <?php
            if ($user_role == 'admin') {
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
            ?>
        </select>
    </div>

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
        <input type="password" class="form-control" name="user_password" autocomplete="off">
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="UPDATE">
    </div>
</form>
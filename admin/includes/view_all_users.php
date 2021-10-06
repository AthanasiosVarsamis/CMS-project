<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>password</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users ";
        $users_query = mysqli_query($connection, $query);
        confirmQuery($users_query);

        while ($row = mysqli_fetch_assoc($users_query)) {

            $user_id = $row['user_id'];
            $user_name = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_name}</td>";
            echo "<td>{$user_password}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td><img width='100' src='../images/{$user_image}'></td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
          

            echo "</tr>";
        }

        ?>
    </tbody>


</table>
<!-- delete query -->
<?php
if (isset($_GET['delete'])) {
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='admin'){
    $user_id = mysqli_real_escape_string($connection,$_GET['delete']);
    $query = "DELETE FROM users WHERE user_id ={$user_id} ";
    $delete_query = mysqli_query($connection, $query);
    confirmQuery($delete_query);
    header("Location: users.php");
        }
    }
}

?>
<!-- Admin/subsriber -->
<?php
if (isset($_GET['change_to_admin'])) {
    $the_user_id = $_GET['change_to_admin'];
    $ad_query = "UPDATE users SET  user_role = 'admin' WHERE user_id = $the_user_id ";
    $admin_query = mysqli_query($connection, $ad_query);
    confirmQuery($admin_query);
    header("Location: users.php");
}
if (isset($_GET['change_to_sub'])) {
    $the_user_id = $_GET['change_to_sub'];
    $sub_query = "UPDATE users SET  user_role = 'subscriber' WHERE user_id = $the_user_id ";
    $subscriber_query = mysqli_query($connection, $sub_query);
    confirmQuery($subscriber_query);
    header("Location: users.php");
}


?>
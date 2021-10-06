
<?php


$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'cms2';

foreach ($db as $key => $values) {
    define(strtoupper($key), $values);
}
//The problem is with the VSCode, it can't properly parse the php code, it "thinks" that those constants don't exist but we created them within the foreach loop.
$connection = mysqli_connect(DB_HOST,DB_USER, DB_PASS,DB_NAME );

// if ($connection) {
//     echo "we are connected";
// }else{
//     echo " we are not connected";
// }
?>
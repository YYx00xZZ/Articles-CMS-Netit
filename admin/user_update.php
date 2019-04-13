<?php
session_start();
include_once ('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
    if (isset($_POST['update'])) {
//        print_r($_POST);
//        print_r($_GET);
        $id = $_GET['id'];
        $username = trim($_POST['username']);
        $password = md5(trim($_POST['password']));
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE `users` SET `user_name` = '$username', `user_password` = '$password' , `user_first_name` = '$fname', `user_last_name` = '$lname' WHERE `user_id` = '$id'";
        $pdo->exec($query);
        header('location: users.php');
    }
} else{
    header('location: index.php');
}
?>
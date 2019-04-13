<?php
    session_start();

    include_once ('../includes/connection.php');
    include_once ('../includes/user.php');

    $user = new User;
    if(isset($_SESSION['logged_in'])) {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = $pdo->prepare('DELETE FROM users WHERE user_id = ?');
            $query->bindValue(1, $id);
            $query->execute();

            header('location: users.php');
        }
        $users = $user->fetch_all_users();
    }else {
        header('location: users.php');
    }
?>
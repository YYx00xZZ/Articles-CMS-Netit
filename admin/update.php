<?php
    session_start();
    include_once ('../includes/connection.php');

    if (isset($_SESSION['logged_in'])) {
        if (isset($_POST['update'])) {
//        print_r($_POST);
//        print_r($_GET);
            $id = $_GET['id'];
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $updatetime = time();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE `articles` SET `article_title` = '$title', `article_content` = '$content' , `article_last_edit` = '$updatetime' WHERE `article_id` = '$id'";
            $pdo->exec($query);
            header('location: index.php');
        }
    } else{
        header('location: index.php');
    }
?>
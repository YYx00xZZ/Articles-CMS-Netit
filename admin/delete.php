<?php

session_start();

include_once ('../includes/connection.php');
include_once ('../includes/article.php');

$article = new Article;

if (isset($_SESSION['logged_in'])) {
//    display delete page
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
        $query->bindValue(1, $id);
        $query->execute();

        header('Location: delete.php');
    }
    $articles = $article->fetch_all();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <!--        <link rel="stylesheet" href="../assets/css/style.css">-->

        <title>CMS</title>
    </head>
    <body class="mt-5">
    <div class="container">
        <div class="row">

            <?php include_once ('../includes/html/left-col.php'); ?>

            <div class="col-xs-7 col-sm-7 col-md-9 col-lg-10">
                <a href="index.php" id="logo">CMS</a>
                <h4 class="mb-0">Select an article to delete</h4>
                <small class="text-muted pl-3">Executes immediately!</small>
                <form class="mt-3" action="delete.php" method="GET">
                    <select class="custom-select" onchange="this.form.submit();" name="id">
                        <?php foreach ($articles as $article) { ?>
                            <option value="<?php echo $article['article_id']; ?>">
                                <?php echo $article['article_title']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </form>

            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
} else {
    header('Location: index.php');
}
?>
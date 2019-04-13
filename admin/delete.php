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

        header('Location: index.php');
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

                    <?php include_once('../assets/html/left-col.php'); ?>

                    <div class="col-xs-7 col-sm-7 col-md-9 col-lg-10 mt-5">
                        <h4 class="mb-0 ml-4">Select an article to delete</h4>
                        <small class="text-muted pl-3 ml-4">Executes immediately!</small>

                        <?php foreach ($articles as $article) { ?>
                            <form class="mt-1" action="delete.php" method="GET">
                                <div class="row">
                                    <div class="col-10">
                                        <label style="font-size:1.9em" for=""><?php echo $article['article_title']; ?></label>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-danger" value="<?php echo $article['article_id']; ?>" name="id">Delete</button>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                        <?php } ?>
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
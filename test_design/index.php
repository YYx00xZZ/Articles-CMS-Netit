<?php
include_once ('includes/connection.php');
include_once ('includes/article.php');

$article = new Article;
$articles = $article->fetch_all();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <title>CMS</title>
    </head>
    <body class="mt-5">

        <div class="container">
            <div class="row">
                <div class="col-2">
                    <a href="admin">ADMIN</a>
                    <br />
<!--                    <a href="user">user</a>-->

                </div>

                <div class="col-10">
                    <a href="index.php" id="logo">CMS</a>

                    <ol class="list-group custom-ol">
                        <?php foreach ($articles as $article) { ?>
                            <li class="list-group-item mb-1 pl-5">
                                <a class="custom-a" href="article.php?id=<?php echo $article['article_id']; ?>">
                                    <?php echo $article['article_title']; ?>
                                </a>
                                - <small class="font-italic">
                                    posted <?php echo date('l jS', $article['article_timestamp']); ?>
                                </small>
                                <small class="float-right">
                                    by {php var}
                                </small>
                            </li>
                        <?php } ?>
                    </ol>
                </div>
            </div>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
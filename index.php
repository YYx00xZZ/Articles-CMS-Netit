<?php
    include_once ('includes/connection.php');
    include_once ('includes/article.php');
    $article = new Article;
    $articles = $article->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>CMS</title>
    </head>
    <body
        <div class="container mt-4">
            <div class="row mb-4">
                <div class="col-12">
                    <a class="btn btn-outline-dark float-right mr-4" href="admin">Admin panel</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php foreach($articles as $article) { ?><div class="card mb-3">
                        <div class="card-header pr-4">
                            <small>
                                ID <?php echo $article['article_id']; ?>
                            </small>
                            <small class="font-italic float-right">
                                Posted <?php echo date('l jS', $article['article_timestamp']); ?>
                            </small>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title text-center mb-4 "><?php echo $article['article_title']; ?></h3>
                            <p class="card-text">
                                <?php echo nl2br(substr($article['article_content'], 0, 300)); ?>...
                            </p>
                        </div>
                        <div class="card-footer p-0">
                            <a class="btn btn-primary btn-block w-100 m-0" href="article.php?id=<?php echo $article['article_id']; ?>">More</a>
                        </div></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    </body>
</html>
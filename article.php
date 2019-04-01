<?php
include_once ('includes/connection.php');
include_once ('includes/article.php');

$article = new Article;
if (isset($_GET['id'])) {
    //display article
    $id = $_GET['id'];
    $data = $article->fetch_data($id);

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
                    <div class="col-12">
                        <a href="index.php" id="logo">CMS</a>

                        <h4 class="pl-3 mb-4">
                            <?php echo $data['article_title']; ?>
                            - <small class="font-italic text-muted font-weight-light">
                                posted <?php echo date('l jS', $data['article_timestamp']); ?>
                            </small>
                        </h4>

                        <p class="content-p"><?php echo $data['article_content']; ?></p>

                        <a href="index.php">&larr; Back</a>
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

<?php
} else {
    header('Location: index.php');
    exit();
}

?>
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
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <title>CMS</title>
        </head>
        <body>
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                    <div class="mr-auto d-sm-flex d-block flex-sm-nowrap">
                        <a class="navbar-brand " href="index.php">Articles CMS</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse text-center" id="navbarsExample11">
                            <ul class="navbar-nav nav-tabs">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">ID <?php echo $data['article_id']; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="container">
                <a class="btn ml-3 mt-1" href="index.php">&larr; Back</a>
                <div class="row mt-4">
                    <div class="offset-2 col-8 offset-2 mt-3">
                        <div class="row mb-0 pb-0">
                            <div class="col-12">
                                <h3 class="mb-4 text-center">
                                    <?php echo $data['article_title']; ?>
                                </h3>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-12">
                                <small class="font-italic float-right">
                                    Posted <?php echo date('l jS', $data['article_timestamp']); ?>
                                    <br/>
                                    <?php if ($data['article_last_edit'] != 0) { ?>
                                        Updated <?php echo date(' l jS', $data['article_last_edit']); ?>
                                    <?php } ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 pl-sm-2 pl-md-4 pl-lg-5 pr-sm-2 pr-md-4 pr-lg-5 mt-5">
                                <p class="content-p"><?php echo nl2br($data['article_content']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../assets/js/jquery-3.3.1.min.js"></script>
            <script src="../assets/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        </body>
    </html>
<?php
    } else {
        header('Location: admin');
        exit();
    }
?>
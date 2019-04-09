<?php
    session_start();
    include_once ('../includes/connection.php');
    if (isset($_SESSION['logged_in'])) {
        if (isset($_POST['title'], $_POST['content'])) {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            if (empty($title) or empty($content)) {
                $error = 'All fields required!';
            } else {
                $query = $pdo->prepare('INSERT INTO articles (article_title, article_content, article_timestamp) VALUES (?, ?, ?)');
                $query->bindValue(1, $title);
                $query->bindValue(2, $content);
                $query->bindValue(3, time());
                $query->execute();
                header('Location: index.php');
            }
        }
    //    display add page
?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <title>CMS</title>
        </head>
        <body class="mt-3">
            <div class="container">
                <?php include_once ('../assets/html/user-details-row.php'); ?>
                <a class="btn ml-3 mt-1" href="index.php">&larr; Back</a>
                <div class="row">
                    <div class="col-12 mt-4">
                        <h4 class="ml-4">Add Article</h4>
                        <?php if (isset($error)) { ?>
                            <small style="color: #aa0000;"><?php echo $error; ?></small>
                            <br /><br />
                        <?php } ?>
                        <form action="add.php" method="POST" autocomplete="off">
                            <input class="form-control" type="text" name="title" placeholder="Title" />
                            <textarea class="form-control mt-1" rows="10" cols="50" placeholder="Content" name="content"></textarea>
                            <input class="btn btn-block btn-outline-dark mt-1" type="submit" value="Add Article" />
                        </form>
                    </div>
                </div>
            </div>
            <script src="../assets/js/jquery-3.3.1.min.js"></script>
            <script src="../assets/js/bootstrap.min.js"></script>
        </body>
    </html>
<?php
    } else {
        header('Location: index.php');
    }
?>
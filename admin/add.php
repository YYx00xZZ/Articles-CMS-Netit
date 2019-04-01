<?php
session_start();

include_once ('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
    if (isset($_POST['title'], $_POST['content'])) {
        $title = $_POST['title'];
        $content = nl2br($_POST['content']);

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
            <div class="col-xs-5 col-sm-5 col-md-3 col-lg-2">
                <img class="mx-auto d-block p-1 rounded-circle" src="https://via.placeholder.com/150" />
                <hr />
                <p class="text-center"><?php echo $_SESSION['logged_in_username']; ?></p>
                <hr />

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="add.php">Add Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="delete.php">Delete Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>

            <div class="col-xs-7 col-sm-7 col-md-9 col-lg-10">
                <a href="index.php" id="logo">CMS</a>

                <h4>Add Article</h4>

                <?php if (isset($error)) { ?>
                    <small style="color: #aa0000;"><?php echo $error; ?></small>
                    <br /><br />
                <?php } ?>

                <form action="add.php" method="POST" autocomplete="off">
                    <input class="form-control" type="text" name="title" placeholder="Title" />
                    <textarea class="form-control mt-1" rows="15" cols="50" placeholder="Content" name="content"></textarea>
                    <input class="btn btn-block btn-outline-dark mt-1" type="submit" value="Add Article" />
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
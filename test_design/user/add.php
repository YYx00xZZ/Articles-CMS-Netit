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
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>CMS</title>
</head>
<body class="mt-5">
<div class="container">
    <div class="row">
        <div style="background-color: pink;" class="col-2">
            <img class="mx-auto d-block p-1 rounded-circle" src="https://via.placeholder.com/150" />
            <hr />
            <p>username placeholder</p>
            <ol>
                <li>
                    <a href="#">link</a>
                </li>
                <li>
                    <a href="add.php">Add article</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ol>
        </div>

        <div class="col-10">
            <!--                <a href="index.php" id="logo">CMS</a>-->
            <h4>Add Article <a class="float-right" href="index.php"><small>&larr; Back</small></a></h4>

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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
    <?php
} else {
    header('Location: index.php');
}

?>
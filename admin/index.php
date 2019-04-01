<?php
session_start();
include_once ('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {

    //display index
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
                    <div class="col-2">
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

                    <div class="col-10">
                        <a href="index.php" id="logo">CMS</a>

                        <?php
                        include_once ('../includes/article.php');

                        $article = new Article;
                        $articles = $article->fetch_all();
                        ?>

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


    <?php
} else {
    //display login

    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'] ;
        $password = md5($_POST['password']);
        $_SESSION['logged_in_username'] = $_POST['username'];
        if (empty($username) or empty($password)) {
            $error = 'All fields are required!';
        } else {
            $query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");

            $query->bindValue(1, $username);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query->rowCount();

            if ($num == 1) {
//                correct
                $_SESSION['logged_in'] = TRUE;
                header('Location: index.php');
            } else {
//                false
                if (empty(trim($_POST['username']))) {
                    $username_err = 'Field required.';
                }
                if (empty(trim($_POST['password']))) {
                    $password_err = 'Password required.';
                }
                $error = 'Incorrect credentials.';
            }
        }
    }
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
            <div class="col-2">

            </div>

            <div class="col-10">
                <a href="index.php" id="logo">CMS</a>

                <br /><br />

                <?php if (isset($error)) { ?>
                    <small style="color: #aa0000;"><?php echo $error; ?></small>
                    <br /><br />
                <?php } ?>
                <form action="index.php" method="POST" autocomplete="off">
                    <input class="form-control" type="text" name="username" placeholder="Username" />
                    <input class="form-control mt-1" type="password" name="password" placeholder="Password" />
                    <input class="btn btn-block btn-outline-dark mt-1" type="submit" value="Log in" />
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
}
?>
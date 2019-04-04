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
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
            <!--        <link rel="stylesheet" href="../assets/css/style.css">-->

            <title>CMS</title>
        </head>
        <body class="mt-5">
            <div class="container">
                <div class="row">

                    <?php include_once('../assets/html/left-col.php'); ?>

                    <div class="col-xs-7 col-sm-7 col-md-9 col-lg-10">
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
                                        ID <?php echo $article['article_id']; ?>
                                    </small>
                                </li>
                            <?php } ?>
                        </ol>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-7 col-sm-7 col-md-9 col-lg-10">

                        <h4>Edit Article</h4>

                        <?php if (isset($error)) { ?>
                            <small style="color: #aa0000;"><?php echo $error; ?></small>
                            <br /><br />
                        <?php } ?>

                        <?php include_once('../assets/html/form-add.html'); ?>

                    </div>
                </div>
            </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="../assets/js/jquery-3.3.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="../assets/js/bootstrap.min.js"></script>
        </body>
    </html>


<?php


    } else {
        //display login
        $username_err = '';
        $password_err = '';
        if (isset($_POST['username'], $_POST['password'])) {
            $username = $_POST['username'] ;
            $password = md5($_POST['password']);
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
                    $_SESSION['logged_in_username'] = $_POST['username'];

                    header('Location: update.php');
                } else {
    //                false

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
                        <input class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" type="text" name="username" placeholder="Username" />
                        <div class="<?php echo (!empty($username_err)) ? 'invalid-feedback' : ''; ?>"><?php echo $username_err; ?></div>
                        <input class="form-control mt-1 <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" name="password" placeholder="Password" />
                        <div class="<?php echo (!empty($password_err)) ? 'invalid-feedback' : ''; ?>"><?php echo $password_err; ?></div>
                        <input class="btn btn-block btn-outline-dark mt-1" type="submit" value="Log in" />
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
}
?>
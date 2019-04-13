<?php
    session_start();
    include_once ('../includes/connection.php');
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
            <link rel="stylesheet" href="../assets/css/style.css">
            <title>CMS</title>
        </head>
        <body>
            <div class="container-fluid">
                <?php include_once('../assets/html/navbar.php'); ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="offset-sm-2 offset-md-3 offset-lg-4 col-sm-8 col-md-6 col-lg-6 offset-sm-2 offset-md-3 offset-lg-1 offset-xl-4 col-xl-8">
                        <div class="d-flex flex-row">
                            <div class="p-1"><a href="add.php" class="btn btn-sm mt-1 mb-3 ml-md-3 ml-xl-5 border-left border-top border-bottom">Add Article</a></div>
                            <div class="p-1"><a href="#" class="btn btn-sm mt-1 mb-3 border-top border-bottom border-left-0 border-right-0 disabled">Create Poll</a></div>
                            <div class="p-1"><a href="#" class="btn btn-sm mt-1 mb-3 border-top border-bottom border-right disabled">Star Article</a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php
                            include_once ('../includes/article.php');
                            $article = new Article;
                            $articles = $article->fetch_all();
                        ?>
                        <?php foreach($articles as $article) { ?>
                            <div class="card mb-3">
                                <div class="card-header pr-4">
                                    <small>
                                        ID <?php echo $article['article_id']; ?>
                                    </small>
                                    <small class="font-italic float-right">
                                        Posted <?php echo date('l jS', $article['article_timestamp']); ?>
                                        <br/>
                                        <?php if ($article['article_last_edit'] != 0) { ?>
                                        Updated <?php echo date(' l jS', $article['article_last_edit']); ?>
                                        <?php } ?>
                                    </small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
                                            <h3 class="card-title text-center mb-4 "><?php echo $article['article_title']; ?></h3>
                                            <p class="card-text">
                                                <?php echo nl2br(substr($article['article_content'], 0, 300)); ?>...
                                            </p>
                                        </div>
                                        <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                                            <a class="btn btn-warning w-100 mb-1" href="edit.php?id=<?php echo $article['article_id'] ?>">Edit</a>
                                            <a class="btn btn-danger w-100" href="delete.php?id=<?php echo $article['article_id'] ?>" onclick="return confirm('Confirm delete');">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                    <a class="btn btn-outline-primary btn-block w-100 m-0" href="article.php?id=<?php echo $article['article_id']; ?>">Read more</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <script src="../assets/js/jquery-3.3.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="../assets/js/bootstrap.min.js"></script>
        </body>
    </html>
<?php
    } else {
        //display login
        $username_err = $password_err = '';
        if (isset($_POST['username'], $_POST['password'])) {
            $username = strtolower(trim($_POST['username']));
            $password = trim(md5($_POST['password']));
            if (empty($username) or empty($password)) {
//                $error = 'All fields are required!';
                $username_err = 'Field required.';
                $password_err = 'Field required.';
            } else {
                $query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
                $query->bindValue(1, $username);
                $query->bindValue(2, $password);
                $query->execute();
                $num = $query->rowCount();
                if ($num == 1) {
//                            correct
                    $_SESSION['logged_in'] = TRUE;
                    $_SESSION['logged_in_username'] = $_POST['username'];
                    header('Location: index.php');
                } else {
//                            false
                    $error = 'Incorrect credentials.';
                    $username_err = $password_err = '&nbsp;';
                }
            }
        }

?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/css/style.css">
            <title>CMS</title>
        </head>
        <body class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="offset-2 col-8 offset-2">
                        <br /><br />
                        <?php if (isset($error)) { ?>
                            <small style="color: #aa0000;"><?php echo $error; ?></small>
                            <br /><br />
                        <?php } ?>
                        <form action="index.php" method="POST" autocomplete="off">
                            <div class="form-group">
                                <label class="pl-3" for="username">Username</label>
                                <input id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" type="text" name="username" placeholder="Enter a valid username" onChange="javascript:this.value=this.value.toLowerCase();" />
                                <div class="<?php echo (!empty($username_err)) ? 'invalid-feedback' : ''; ?>"><?php echo $username_err; ?></div>
                            </div>
                            <div class="form-group mt-3">
                                <label class="pl-3" for="password">Password</label>
                                <input id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" name="password" placeholder="Enter a valid password" />
                                <div class="<?php echo (!empty($password_err)) ? 'invalid-feedback' : ''; ?>"><?php echo $password_err; ?></div>
                            </div>
                            <div class="form-group mt-3">
                                <input class="btn btn-block btn-outline-dark mt-1" type="submit" value="Log in" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="../assets/js/jquery-3.3.1.min.js"></script>
            <script src="../assets/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        </body>
    </html>
<?php
    }
?>
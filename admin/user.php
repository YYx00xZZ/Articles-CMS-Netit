<?php
    session_start();
    include_once ('../includes/connection.php');
    if (isset($_SESSION['logged_in'])) {
        //display index
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
        <body class="mt-5">
            <div class="container">
                <?php include_once('../assets/html/navbar.php'); ?>
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card-deck">
                            <?php
                                include_once ('../includes/user.php');
                                $user = new User;
                                $users = $user->fetch_all_users();
                                ?>
                            <?php foreach ($users as $user) { ?>
                                <div class="card">
                                    <img class="card-img-top" src="https://via.placeholder.com/200x25" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Username: <?php echo $user['user_name']; ?></h5>
                                        <p class="card-text">First name <?php echo $user['user_first_name'] ?></p>
                                        <p class="card-text">Last name <?php echo $user['user_last_name']; ?></p>
                                        <p class="card-text">Email: <?php echo $user['user_email']; ?></p>
                                        <p class="card-text"><small class="text-muted">ID <?php echo $user['user_id']; ?></small></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
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
        $username_err = '';
        $password_err = '';
        if (isset($_POST['username'], $_POST['password'])) {
            $username = trim($_POST['username']) ;
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
                                <input id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" type="text" name="username" placeholder="Enter a valid username" />
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
<?php
    session_start();

    if(isset($_SESSION['logged_in'])) {


    include_once('../includes/connection.php');

$username = $pwd = $pwd2 = $fname = $lname = '';
$username_err = $pwd_err = $pwd2_err = $fname_err = $lname_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    print_r($_POST);
    //valid username
        if(empty(trim($_POST['username']))){
            $username_err = "Username is required";
        } else{
            $query = $pdo->prepare("SELECT user_id FROM users WHERE user_name = ?");
            $query->bindValue(1, $username);
            $username = trim($_POST['username']);
            if($query->execute()){
                $row = $query->rowCount();
                if($row == 1) {
                    $username_err = 'Username already taken';
                } else{
                    $username = trim($_POST['username']);
                }
            } else{
                echo 'Oops. Try again.';
            }
            unset ($query);
        }

        //valid pwd
        if(empty(trim($_POST['pwd']))){
            $pwd_err = 'Please enter a password.';
        } elseif(strlen(trim($_POST['pwd'])) < 8){
            $pwd_err = 'Password must be at least 8 characters.';
        } else {
            $pwd = (trim($_POST['pwd']));
        }

        //valid pwd2
        if(empty(trim($_POST['pwd2']))){
            $pwd2_err = 'Please enter the same password again';
        } else{
            $pwd2 = trim($_POST['pwd2']);
            if(empty($pwd2_err) && ($pwd != $pwd2)) {
                $pwd2_err = 'Password did not match';
            }
        }

        //valid fname
    if(empty(trim($_POST['fname']))){
        $fname_err = 'Please enter first name';
    } else {
        $fname = trim($_POST['fname']);
    }

    //valid lname
    if(empty(trim($_POST['lname']))){
        $lname_err = 'Please enter last name';
    } else {
        $lname = trim($_POST['lname']);
    }

        if(empty($username_err) && empty($pwd_err) && empty($pwd2_err) && empty($fname_err) && empty($lname_err)){
            $username = trim($_POST['username']);
            $pwd = md5(trim($_POST['pwd']));
//            print_r($_POST);
            $query = $pdo->prepare("INSERT INTO users (user_name, user_password, user_first_name, user_last_name, user_created_at) VALUES (?, ?, ?, ?, ?)");
            $query->bindValue(1, $username);
            $query->bindValue(2, $pwd);
            $query->bindValue(3, $fname);
            $query->bindValue(4, $lname);
            $query->bindValue(5, time());

            if ($query->execute()){
                header('location: users.php');
            } else {
                echo 'Try again.';
            }
        }
        unset($query);
        unset($pdo);
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
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?php include_once('../assets/html/navbar.php'); ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="offset-sm-2 offset-md-5 offset-lg-5 col-sm-8 col-md-6 col-lg-6 offset-sm-2 offset-md-1 offset-lg-1 offset-xl-5 col-xl-6">
            <div class="d-flex flex-row">
                <div class="p-1"><a href="users.php" class="btn btn-sm mt-1 mb-3 ml-lg-4 ml-xl-5 ml-2 border-left border-top border-bottom">&larr; Back</a></div>
                <div class="p-1"><a href="#" class="btn btn-sm mt-1 mb-3 border-top border-bottom border-left-0 border-right-0 disabled">Promote User</a></div>
                <div class="p-1"><a href="#" class="btn btn-sm mt-1 mb-3 border-top border-bottom border-right disabled">Ban User</a></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-12">
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" id="username" placeholder="username" />
                        <div class="<?php echo (!empty($username_err)) ? 'invalid-feedback' : ''; ?>"><?php echo $username_err; ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pwd" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-12">
                        <input type="password" class="form-control <?php echo (!empty($pwd_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pwd; ?>
" id="pwd" placeholder="password" name="pwd" />
                        <div class="<?php echo (!empty($pwd_err)) ? 'invalid-feedback' : ''; ?>"><?php echo $pwd_err; ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pwd2" class="col-sm-2 col-form-label">Confirm password</label>
                    <div class="col-12">
                        <input type="password" class="form-control <?php echo (!empty($pwd2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pwd2; ?>
" id="pwd2" placeholder="Confirm password" name="pwd2" />
                        <div class="<?php echo (!empty($pwd2_err)) ? 'invalid-feedback' : ''; ?>"><?php echo $pwd2_err; ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 col-form-label">First name</label>
                    <div class="col-12">
                        <input type="text" class="form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>
" id="fname" placeholder="First Name" name="fname" />
                        <div class="<?php echo (!empty($fname_err)) ? 'invalid-feedback' : ''; ?>"><?php echo $fname_err; ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lname" class="col-sm-2 col-form-label">Last name</label>
                    <div class="col-12">
                        <input type="text" class="form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>
" id="lanme" placeholder="Last Name" name="lname" />
                        <div class="<?php echo (!empty($lname_err)) ? 'invalid-feedback' : ''; ?>"><?php echo $lname_err; ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="submit" class="btn btn-primary" value="Submit" />
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
<?php } else {
        header('location: index.php');
    } ?>
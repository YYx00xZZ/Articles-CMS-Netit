<?php
session_start();
include_once ('../includes/connection.php');
include_once ('../includes/user.php');
if (isset($_SESSION['logged_in'])) {
    $user = new User;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = $user->fetch_data_user($id);
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <!--        <link rel="stylesheet" href="../assets/css/style.css">-->

        <title>CMS</title>
    </head>
    <body>
    <div class="container-fluid">
        <?php include_once ('../assets/html/user-details-row.php'); ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="user_update.php?id=<?php echo $data['user_id']; ?>">
                    <div class="row mt-5 mb-5 p-1">
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text text-body">USER ID</div>
                                </div>
                                <input type="text" class="form-control" id="id" value="<?php echo $data['user_id']; ?>">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text text-body">USERNAME</div>
                                </div>
                                <input type="text" class="form-control" id="displayUsername" value="<?php echo $data['user_name']; ?>">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text text-body">MEMBER SINCE</div>
                                </div>
                                <input type="text" class="form-control" id="id" value="<?php echo date('d/m/Y', $data['user_created_at']); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" name="username" type="text" class="form-control" value="<?php echo $data['user_name']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Enter new password for this user" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input name="fname" type="text" class="form-control" value="<?php echo $data['user_first_name']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <label for="lname">Last Name</label>
                            <input name="lname" type="text" class="form-control" value="<?php echo $data['user_last_name']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input name="email" type="email" class="form-control" id="email" value="<?php echo $data['user_email']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input class="btn btn-primary form-control mt-4" type="submit" name="update" value="Edit" onclick="return confirm('Submit?');" />
                        </div>
                    </div>
                </form>
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
    header('location: users.php');
}
?>
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
        <?php include_once('../assets/html/navbar.php'); ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="user_update.php?id=<?php echo $data['user_id']; ?>">
                    <div class="row mt-5 mb-3 p-1">
                        <div class="col-12">
                            <ul class="list-group list-group-horizontal-sm mx-auto justify-content-center">
                                <li class="list-group-item text-center">User ID: <span class="pl-3"><?php echo $data['user_id']; ?></span></li>
                                <li class="list-group-item text-center">Username: <span class="pl-3"><?php echo $data['user_name']; ?></span></li>
                                <li class="list-group-item text-center">Member since: <span class="pl-3"><?php echo date('d/m/Y', $data['user_created_at']); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend w-25">
                                    <div class="input-group-text w-100">Username</div>
                                </div>
                                <input id="username" name="username" type="text" class="form-control" value="<?php echo $data['user_name']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend w-25">
                                    <div class="input-group-text w-100">Password</div>
                                </div>
                                <!--input-->
                                <input name="password" type="text" class="form-control" placeholder="Enter new password for this user" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend w-25">
                                    <div class="input-group-text w-100">First Name</div>
                                </div>
                                <!--input-->
                                <input name="fname" type="text" class="form-control" value="<?php echo $data['user_first_name']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend w-25">
                                    <div class="input-group-text w-100">Last Name</div>
                                </div>
                                <!--input-->
                                <input name="lname" type="text" class="form-control" value="<?php echo $data['user_last_name']; ?>" />

                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend w-25">
                                    <div class="input-group-text w-100">Email @</div>
                                </div>
                                <input name="email" type="email" class="form-control" id="email" value="<?php echo $data['user_email']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input class="btn btn-warning form-control mt-4" type="submit" name="update" value="Update" onclick="return confirm('Submit?');" />
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
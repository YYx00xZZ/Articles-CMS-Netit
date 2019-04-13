<?php
    session_start();
    include_once ('../includes/connection.php');
    include_once ('../includes/user.php');
    $user = new User;
    if (isset($_SESSION['logged_in'])) {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = $pdo->prepare('DELETE FROM users WHERE user_id = ?');
            $query->bindValue(1, $id);
            $query->execute();
            header('location: index.php');
        }
        $users = $user->fetch_all_users();
?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <title>CMS</title>
        </head>
        <body>
            <div class="container-fluid">
                <?php include_once ('../assets/html/user-details-row.php'); ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="offset-sm-2 offset-md-5 offset-lg-5 col-sm-8 col-md-6 col-lg-6 offset-sm-2 offset-md-1 offset-lg-1 offset-xl-5 col-xl-6">
                        <div class="d-flex flex-row">
                            <div class="p-1"><a href="user_add.php" class="btn btn-sm mt-1 mb-3 ml-lg-4 ml-xl-5 ml-2 border-left border-top border-bottom">Add User</a></div>
                            <div class="p-1"><a href="#" class="btn btn-sm mt-1 mb-3 border-top border-bottom border-left-0 border-right-0 disabled">Promote User</a></div>
                            <div class="p-1"><a href="#" class="btn btn-sm mt-1 mb-3 border-top border-bottom border-right disabled">Ban User</a></div>
                        </div>
                    </div>
                </div>

                <?php
                $numberOfColumns = 3;
                $bootstrapColWidth = 12 / $numberOfColumns ;
                $arrayChunks = array_chunk($users, $numberOfColumns);
                foreach($arrayChunks as $users) {
                    echo '<div class="row">';
                    foreach($users as $user) {
                        echo '<div class="col-md-'.$bootstrapColWidth.'">';
                        ?>
<!--                         your item-->
                        <div class="card h-100 mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-monospace">Username: <span class="text-weight-normal"><?php echo $user['user_name']; ?></span></h5>
                                <p class="card-text"><?php echo $user['user_email']; ?></p>
                                <p class="card-text"><small class="text-muted">Account created on <?php echo date('d/m/Y', $user['user_created_at']); ?></small></p>
                            </div>
                            <div class="card-footer h-50 text-muted">
                                <a class="btn btn-warning w-100 btn-block" href="user_edit.php?id=<?php echo $user['user_id']; ?>"><span class="font-weight-lighter">Manage user</span> <?php echo $user['user_name']; ?></a>
                                <a class="btn btn-danger w-100 btn-block" href="user_delete.php?id=<?php echo $user['user_id']; ?>" onclick="return confirm('Confirm delete');"><span class="font-weight-bolder">Delete</a>
                            </div>
                        </div>
                        <?php
                        echo '</div>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        </body>
        </html>



        <?php
    } else {
        header ('location: admin');
    }
?>
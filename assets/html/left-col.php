<div class="mb-5 col-xs-5 col-sm-5 col-md-3 col-lg-2">
    <img class="mx-auto d-block p-1 rounded-circle" src="https://via.placeholder.com/150" />
    <hr />
    <p class="text-center font-weight-bolder">
        <?php echo $_SESSION['logged_in_username']; ?>
    </p>
    <hr />
    <ul class="nav flex-xs-row flex-sm-column flex-md-column flex-lg-column">
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="index.php">Home</a>-->
<!--        </li>-->
        <li class="nav-item">
            <a class="nav-link active" href="add.php">Add article</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="update.php">Edit article</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="delete.php">Delete article</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    </ul>
</div>

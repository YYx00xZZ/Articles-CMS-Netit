<div class="row">
    <div class="col-2">
        <img class="mx-auto d-block p-0 m-0 rounded-circle" src="https://via.placeholder.com/120" />
    </div>
    <div class="col-7">
        <p class="text-center font-weight-bold">Logged in as: <?php echo $_SESSION['logged_in_username']; ?></p>
    </div>
    <div class="col-3">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link btn btn-sm btn-outline-dark mr-1" href="add.php">Add article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-outline-dark" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<hr/>
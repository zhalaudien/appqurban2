<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <span class="ml-3 font-weight-bold"><?= $title ?? '' ?></span>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
        </li>
    </ul>

</nav>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="<?= route("/admin") ?>">Admin</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">Ajouter un produit <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Ajouter un client <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Lister les clients <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0 d-flex align-items-center">
            <p>Today's date is : <b><?= date("d F Y") ?></b> <a href="<?= route("/login/logout") ?>"class="btn btn-sm btn-secondary">Logout</a></p>
            
        </div>
    </div>
</nav>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="logo.png" width="40px" height="40px" />
            Restoran Astoria
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Rezerviraj stol</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="naruci.php">Naruči unaprijed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#galerija">Galerija</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <?php if (!isset($prijavljeni_korisnik)) : ?>
                    <a href="register.php" id="registracija">Registriraj se</a>
                    <a href="login.php" id="prijava">Prijavi se</a>
                <?php endif ?>
                <?php if (isset($prijavljeni_korisnik)) : ?>
                    <div class="btn-group">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo ("Prijavljeni ste kao " . $prijavljeni_korisnik["ime"] . " " . $prijavljeni_korisnik["prezime"]) . "!" ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">
                                <svg width="1.3em" height="2em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                <?php echo ($prijavljeni_korisnik["ime"] . " " . $prijavljeni_korisnik["prezime"]) ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item">
                                <svg width="1.3em" height="2em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z" />
                                    <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z" />
                                </svg>
                                Logout</a>
                        </div>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </nav>
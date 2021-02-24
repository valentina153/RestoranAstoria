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
                <a class="nav-link" href="rezerviraj.php">Rezerviraj stol</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="naruci.php">Naruči unaprijed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php#galerija">Galerija</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <?php if ($prijavljeni_korisnik == 0) : ?>
                <a href="register.php" id="registracija">Registriraj se</a>
                <a href="login.php" id="prijava">Prijavi se</a>
            <?php endif ?>
            <?php if ($prijavljeni_korisnik != 0) : ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo ("Prijavljeni ste kao " . $prijavljeni_korisnik["ime"] . " " . $prijavljeni_korisnik["prezime"]) . "!" ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="pregled.php">
                            <svg width="1.3em" height="2em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            Moj profil
                        </a>
                        <?php if ($prijavljeni_korisnik["uloga"] == "administrator") : ?>
                            <a class="dropdown-item" href="pregled.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                    <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                </svg>
                                Administracija korisnika

                            </a>
                        <?php endif ?>
                        <div class="dropdown-divider" href="pregled.php"></div>
                        <a href="logout.php" class="dropdown-item">
                            <svg width="1.3em" height="2em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z" />
                                <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z" />
                            </svg>
                            Odjavite se</a>
                    </div>
                </div>
            <?php endif ?>
        </form>
    </div>
</nav>
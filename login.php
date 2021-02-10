<?php
session_start();

require("db.php");

if (isset($_POST["emailKorisnika"])) {
    if ($_POST["emailKorisnika"] == "" || $_POST["lozinkaKorisnika"] == "") {
        $greska = "Molimo unesite Vašu email adresu i lozinku.";
    } else {
        $SQL = "SELECT ID FROM korisnik WHERE ";
        $SQL .= "email='" . $_POST["emailKorisnika"] . "' AND ";
        $SQL .= " lozinka='" . md5($_POST["lozinkaKorisnika"]) . "'";
        $rezultat = mysqli_query($konekcija, $SQL);

        if (mysqli_num_rows($rezultat) == 0) {
            $greska = "Vaši korisnički podaci nisu ispravni molimo pokušajte ponovo.";
        } else {
            $korisnik = mysqli_fetch_assoc($rezultat);
            $_SESSION["token"] = $korisnik["ID"];
            header("Location: index.php");
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Restoran Astoria</title>

</head>

<body class="register">
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
                    <a class="nav-link" href="#">Naruči unaprijed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#galerija">Galerija</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a href="register.php" id="registracija">Registriraj se</a>
                <a href="login.php" id="prijava">Prijavi se</a>
                <?php if (isset($prijavljeni_korisnik)) : ?>
                    <div class="btn-group">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">
                                <svg width="1.3em" height="2em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                Account</button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" type="button">
                                <svg width="1.3em" height="2em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z" />
                                    <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z" />
                                </svg>
                                Logout</button>
                        </div>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </nav>

    <div class="jumbotron" id="registracijaForma">
        <form method="POST" action="login.php">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend input">
                        <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-briefcase-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z" />
                                <path fill-rule="evenodd" d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5v1.384l-7.614 2.03a1.5 1.5 0 0 1-.772 0L0 5.884V4.5zm5-2A1.5 1.5 0 0 1 6.5 1h3A1.5 1.5 0 0 1 11 2.5V3h-1v-.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V3H5v-.5z" />
                            </svg></span>
                    </div>
                    <input type="email" class="form-control rounded-right input" name="emailKorisnika" placeholder="E-mail" required>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend inputLozinka">
                        <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z" />
                                <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                            </svg></span>
                    </div>
                    <input type="password" class="form-control rounded-right inputLozinka" name="lozinkaKorisnika" placeholder="Lozinka" aria-describedby="passwordRequirement" required>
                </div>
                <br>
                <p>Nemate račun? Registrirajte se <a href="register.php">ovdje</a>.</p>
                <?php if (isset($greska)) : ?>
                    <div class="alert alert-danger"><?php echo ($greska) ?></div>
                <?php endif ?>
                <button type="submit" class="btn btn-outline-secondary">Prijavi se</button>
            </div>

        </form>

    </div>



    <div class="footer">
        <br /><b>Radno vrijeme</b><br />
        <img src="decor.png" />
        <p>
            <b>Pon-Čet: </b>8:00 - 17:00<br />
            <b>Pet-Ned: </b>8:00 - 23:00
        </p>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start();

require("model/db.php");
include("model/korisnik_class.php");

$prijavljeni_korisnik = Korisnik::prijavljen();

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
    <div class="blur">

        <?php include('static/navbar.php') ?>

        <div class="jumbotron" id="registracijaForma">
            <form method="POST" action="login.php">
                <div class="form-group">
                <?php if (isset($greska)) : ?>
                        <div class="alert alert-danger"><?php echo ($greska) ?></div>
                    <?php endif ?>
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
                    <button type="submit" class="btn btn-outline-secondary">Prijavi se</button>
                </div>

            </form>

        </div>

        <?php include('static/footer.php') ?>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
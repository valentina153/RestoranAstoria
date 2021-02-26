<?php
session_start();

require("model/db.php");
include("model/korisnik_class.php");

$prijavljeni_korisnik = Korisnik::prijavljen();
$z = 1;
if (isset($_POST["registracija"])) {
    if ($_POST["imeKorisnika"] == "" || $_POST["prezimeKorisnika"] == "" || $_POST["emailKorisnika"] == "" || $_POST["mobitelKorisnika"] == "" || $_POST["lozinkaKorisnika"] == "" || $_POST["pLozinkaKorisnika"] == "") {
        $greska = "Molimo unesite sva polja.";
    } else if ($_POST["lozinkaKorisnika"] != $_POST["pLozinkaKorisnika"]) {
        $greska = "Lozinke se ne podudaraju. Pokušajte ponovo.";
    } else if (Korisnik::zauzetEmail($_POST["emailKorisnika"]) == 1) {
        $greska = "Email je već zauzet. Pokušajte ponovo.";
    } else if (Korisnik::zauzetBroj($_POST["mobitelKorisnika"]) == 1) {
        $greska = "Broj mobitela je već zauzet. Pokušajte ponovo.";
    } else {
        $upit = "INSERT INTO korisnik VALUES (null, '";
        $upit .= $_POST["imeKorisnika"] . "', '";
        $upit .= $_POST["prezimeKorisnika"] . "', '";
        $upit .= $_POST["emailKorisnika"] . "', '";
        $upit .= $_POST["mobitelKorisnika"] . "', '";
        $upit .= md5($_POST["lozinkaKorisnika"]) . "', 'korisnik');";
        $rez = mysqli_query($konekcija, $upit);
        $z = 0;
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

<body class="pozadina1">
    <div class="blur">
        
        <?php include('static/navbar.php') ?> 

        <div class="jumbotron" id="forma">
            <form method="POST" action="register.php">
                <div class="form-group">

                    <?php if (isset($greska)) : ?>
                        <div class="alert alert-danger"><?php echo ($greska); ?></div>
                    <?php endif ?>
                    <?php if ($z == 0) : ?>
                        <div class="alert alert-success uspjeh">Uspješno ste se registrirali.</div>
                    <?php endif ?>
                    <div class="input-group">
                        <div class="input-group-prepend input">
                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg></span>
                        </div>
                        <input type="text" class="form-control rounded-right input" name="imeKorisnika" placeholder="Ime" required>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend input">
                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg></span>
                        </div>
                        <input type="text" class="form-control rounded-right input" name="prezimeKorisnika" placeholder="Prezime" required>
                    </div>
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
                        <div class="input-group-prepend input">
                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z" />
                                </svg></span>
                        </div>
                        <input type="tel" pattern="[+][0-9]{11}" class="form-control rounded-right input" name="mobitelKorisnika" placeholder="Broj mobitela (+xxxxxxxxxxx)" required>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend inputLozinka">
                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z" />
                                    <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                                </svg></span>
                        </div>
                        <input type="password" pattern=".{8,}" class="form-control rounded-right inputLozinka" name="lozinkaKorisnika" placeholder="Lozinka" aria-describedby="passwordRequirement" required>
                    </div>

                    <small id="passwordRequirement" class="form-text text-muted">Vaša lozinka mora sadržavati minimalno 8 znakova.</small>

                    <div class="input-group">
                        <div class="input-group-prepend input">
                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z" />
                                    <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                                </svg></span>
                        </div>
                        <input type="password" class="form-control rounded-right input" name="pLozinkaKorisnika" placeholder="Ponovite lozinku" required>
                    </div>

                    <br>
                    <p>Imate račun? Prijavite se <a href="login.php">ovdje</a>.</p>

                    <button type="submit" name="registracija" class="btn btn-outline-secondary registrirajSe">Registriraj se</button>
                </div>
            </form>
        </div>

        <?php include('static/footer.php') ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
<?php
include("model/db.php");
include("model/stol_class.php");
include("model/rezervacija_class.php");
include("model/korisnik_class.php");

$prijavljeni_korisnik = Korisnik::prijavljen();

$z = 1;
if (isset($_POST["submit"])) {
    if (Rezervacija::zauzetoSve() == 1) {
        $datum = DateTime::createFromFormat('Y-m-d', $_POST["datum"]);
        $datum = $datum->format('d-m-Y');
        $greska = "Svi termini su popunjeni na dan " . $datum;
    } else if (Rezervacija::zauzetTermin() == 1) {
        $datum = DateTime::createFromFormat('Y-m-d', $_POST["datum"]);
        $datum = $datum->format('d-m-Y');
        $greska = "Svi stolovi su zauzeti na dan " . $datum . " u terminu " . Rezervacija::dajTerminID($_POST["termin"]);
    } else if (Rezervacija::zauzeto() == 1) {
        $datum = DateTime::createFromFormat('Y-m-d', $_POST["datum"]);
        $datum = $datum->format('d-m-Y');
        $greska = "Odabrani stol je zauzet na dan " . $datum . " u terminu " . Rezervacija::dajTerminID($_POST["termin"]);
    } else {
        Rezervacija::rezerviraj();
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

<body class="register">
    <div class="blur">
        <?php include("static/navbar.php") ?>

        <div class="jumbotron" id="registracijaForma">
            <form method="POST" action="rezerviraj.php" id="rezervacija">
                <div class="form-group">
                    <?php if (isset($greska)) : ?>
                        <div class="alert alert-danger"><?php echo ($greska); ?></div>
                    <?php endif ?>
                    <?php if ($z == 0) : ?>
                        <div class="alert alert-success uspjeh">Uspješno ste rezervirali stol.</div>
                    <?php endif ?>

                    <div class="input-group">
                        <div class="input-group-prepend input">
                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date-fill" viewBox="0 0 16 16">
                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2z" />
                                    <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z" />
                                </svg>
                            </span>
                        </div>
                        <input type="date" class="form-control rounded-right input" name="datum" min="<?php echo (date("Y-m-d")); ?>" value="<?php echo (date("Y-m-d")); ?>" required>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend input">
                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                </svg>
                            </span>
                        </div>
                        <select class="form-select input" aria-label="termin" name="termin" required>
                            <option value=""> Izaberi termin </option>
                            <?php foreach (Rezervacija::dajTermin() as $termin) : ?>
                                <option value=<?php echo ($termin["ID"]) ?> id="<?php echo ("termin" . $termin["ID"]) ?>"><?php echo ($termin["vrijeme"]) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend input">
                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                </svg>
                            </span>
                        </div>

                        <select class="form-select input" aria-label="stol" name="stol" required>
                            <option value="">Izaberi stol</option>
                            <?php foreach (Stol::dajStol() as $stol) : ?>
                                <option value=<?php echo ($stol["ID"]) ?> id="<?php echo ("stol" . $stol["ID"]) ?>"><?php echo ($stol["naziv"] . " - " . $stol["opis"]) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="komentar" placeholder="Dodatne napomene uz Vašu rezervaciju" id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>

                    <button type="submit" class="btn btn-outline-secondary" name="submit">Rezerviraj</button>
                </div>

            </form>
            <?php
            if ($prijavljeni_korisnik == 0) {
                echo ('
                <div class="alert alert-warning" role="alert" style="text-align:center">
                Morate biti prijavljeni na sustav! <br>
                <a href="login.php" class="alert-link">Prijavite se</a>
                <a href="register.php" class="alert-link" style="margin-left:50px">Registrirajte se</a>
                </div>
                <script>
                document.getElementById("rezervacija").style.display="none";
                </script>
                ');
            }
            ?>

        </div>

        <?php include('static/footer.php') ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>
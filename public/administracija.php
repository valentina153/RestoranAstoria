<?php
session_start();

require("model/db.php");
include("model/korisnik_class.php");

$prijavljeni_korisnik = Korisnik::prijavljen();

if ($prijavljeni_korisnik == 0) header("Location: login.php");

$z = 1;
if (isset($_POST["add"])) {
    if ($_POST["lozinkaKorisnika"] != $_POST["pLozinkaKorisnika"]) {
        $greska = "Lozinke se ne podudaraju. Pokušajte ponovo.";
    } else if (Korisnik::zauzetEmail($_POST["emailKorisnika"]) == 1) {
        $greska = "Email je već zauzet. Pokušajte ponovo.";
    } else if (Korisnik::zauzetBroj($_POST["mobitelKorisnika"]) == 1) {
        $greska = "Broj mobitela je već zauzet. Pokušajte ponovo.";
    } else if ($prijavljeni_korisnik["uloga"] == "administrator") {
        Korisnik::dodaj($_POST);
        $z = 0;
    }
}

if (isset($_POST["update"])) {
    if (Korisnik::zauzetEmailUpdate($_POST["emailKorisnika"], $_POST["idKorisnika"]) == 1) {
        $greska = "Email je već zauzet. Pokušajte ponovo.";
    } else if (Korisnik::zauzetBrojUpdate($_POST["mobitelKorisnika"], $_POST["idKorisnika"]) == 1) {
        $greska = "Broj mobitela je već zauzet. Pokušajte ponovo.";
    } else if ($prijavljeni_korisnik["uloga"] == "administrator") {
        Korisnik::uredi($_POST);
        $z = 2;
    }
}

if (isset($_GET["delete"])) {
    if ($prijavljeni_korisnik["uloga"] == "administrator") {
        Korisnik::izbrisi($_GET["id"]);
    }
}
?>


<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Restoran Astoria</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="pozadina1">
    <div class="blur">

        <?php include('static/navbar.php') ?>

        <div class="container-fluid administracija">

            <?php if (isset($greska)) : ?>
                <div class="alert alert-danger alert-admin"><?php echo ($greska); ?></div>
            <?php endif ?>
            <?php if ($z == 0) : ?>
                <div class="alert alert-success alert-admin uspjeh">Uspješno ste dodali novog korisnika.</div>
            <?php endif ?>
            <?php if ($z == 2) : ?>
                <div class="alert alert-success alert-admin uspjeh">Uspješno ste uredili korisnika.</div>
            <?php endif ?>

            <table class="table-secondary table-bordered table-hover">
                <tr>
                    <th>Broj korisnika</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>E-mail</th>
                    <th>Broj mobitela</th>
                    <th>Uloga</th>
                    <th>Uredi / Briši</th>
                </tr>
                <?php foreach (Korisnik::dajSve() as $korisnik) : ?>
                    <tr>
                        <td><?php echo ($korisnik["ID"]) ?></td>
                        <td><?php echo ($korisnik["ime"]) ?></td>
                        <td><?php echo ($korisnik["prezime"]) ?></td>
                        <td><?php echo ($korisnik["email"]) ?></td>
                        <td><?php echo ($korisnik["brojMobitela"]) ?></td>
                        <td><?php echo ($korisnik["uloga"]) ?></td>
                        <td style="text-align:center">
                            <button type="button" class="btn btn-outline-primary btn-secondary edit" data-bs-toggle="modal" data-bs-target="#staticBackdropUpdate">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-secondary izbrisi" data-bs-toggle="modal" data-bs-target="#staticBackdropDelete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <button type="button" class="btn btn-secondary add" data-bs-toggle="modal" data-bs-target="#staticBackdropAdd">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg>
            </button>

            <!-- Modal za dodavanje novog korisnika -->
            <div class="modal fade" id="staticBackdropAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Dodaj novog korisnika</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="administracija.php">
                                <div class="form-group">
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
                                    <small id="passwordRequirement" class="form-text text-muted">Lozinka mora sadržavati minimalno 8 znakova.</small>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z" />
                                                    <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                                                </svg></span>
                                        </div>
                                        <input type="password" class="form-control rounded-right input" name="pLozinkaKorisnika" placeholder="Ponovite lozinku" required>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <select class="form-select input" name="uloga" aria-label="Uloga" required>
                                            <option value="">Uloga</option>
                                            <option value="administrator">Administrator</option>
                                            <option value="voditelj">Voditelj</option>
                                            <option value="korisnik">Korisnik</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="add" id="add" class="btn btn-secondary modalButton">Dodaj</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal za uredivanje korisnika -->
            <div class="modal fade" id="staticBackdropUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Uredi korisnika</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="administracija.php">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ol" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z" />
                                                    <path d="M1.713 11.865v-.474H2c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 0 1-.492.594v.033a.615.615 0 0 1 .569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V9H1.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 0 0-.342.338v.041zM2.564 5h-.635V2.924h-.031l-.598.42v-.567l.629-.443h.635V5z" />
                                                </svg></span>
                                        </div>
                                        <input type="text" class="form-control rounded-right input" name="idKorisnika" id="idKorisnika" readonly required>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                                </svg></span>
                                        </div>
                                        <input type="text" class="form-control rounded-right input" name="imeKorisnika" id="imeKorisnika" required>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                                </svg></span>
                                        </div>
                                        <input type="text" class="form-control rounded-right input" name="prezimeKorisnika" id="prezimeKorisnika" required>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-briefcase-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z" />
                                                    <path fill-rule="evenodd" d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5v1.384l-7.614 2.03a1.5 1.5 0 0 1-.772 0L0 5.884V4.5zm5-2A1.5 1.5 0 0 1 6.5 1h3A1.5 1.5 0 0 1 11 2.5V3h-1v-.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V3H5v-.5z" />
                                                </svg></span>
                                        </div>
                                        <input type="email" class="form-control rounded-right input" name="emailKorisnika" id="emailKorisnika" required>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z" />
                                                </svg></span>
                                        </div>
                                        <input type="tel" pattern="[+][0-9]{11}" class="form-control rounded-right input" name="mobitelKorisnika" id="mobitelKorisnika" required>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <select class="form-select input" name="uloga" id="uloga" aria-label="Uloga" required>
                                            <option value="">Uloga</option>
                                            <option value="administrator">Administrator</option>
                                            <option value="voditelj">Voditelj</option>
                                            <option value="korisnik">Korisnik</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="update" id="update" class="btn btn-secondary modalButton">Uredi</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal za brisanje korisnika -->
            <div class="modal fade" id="staticBackdropDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Brisanje korisnika</h5>
                        </div>
                        <form method="GET" action="administracija.php">
                            <div class="modal-body">
                                <p>Jeste li sigurni da želite izbrisati korisnika?</p>
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Odustani</button>
                                <button type="submit" name="delete" class="btn btn-danger">Izbriši</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include('static/footer.php') ?>
    </div>

    <script>
        $(document).ready(function() {
            $('.edit').on('click', function() {

                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#idKorisnika').val(data[0]);
                $('#imeKorisnika').val(data[1]);
                $('#prezimeKorisnika').val(data[2]);
                $('#emailKorisnika').val(data[3]);
                $('#mobitelKorisnika').val(data[4]);
                $('#uloga').val(data[5]);
            });
        });

        $(document).ready(function() {
            $('.izbrisi').on('click', function() {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id').val(data[0]);
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
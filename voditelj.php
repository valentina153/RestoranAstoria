<?php
session_start();

require("model/db.php");
include("model/korisnik_class.php");
include("model/jelo_class.php");
include("model/kategorijaJela_class.php");

$prijavljeni_korisnik = Korisnik::prijavljen();

if ($prijavljeni_korisnik == 0) header("Location: voditelj.php");

$z = 1;
if (isset($_POST["add"])) {
    if ($prijavljeni_korisnik["uloga"] == "voditelj") {
        Jelo::dodaj($_POST);
        $z = 0;
    }
}

if (isset($_POST["update"])) {
    if ($prijavljeni_korisnik["uloga"] == "voditelj") {
        Jelo::uredi($_POST);
        $z = 2;
    }
}

if (isset($_GET["delete"])) {
    if ($prijavljeni_korisnik["uloga"] == "voditelj") {
        Jelo::izbrisi($_GET["id"]);
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

        <div class="container-fluid voditelj">

            <?php if (isset($greska)) : ?>
                <div class="alert alert-danger alert-voditelj"><?php echo ($greska); ?></div>
            <?php endif ?>
            <?php if ($z == 0) : ?>
                <div class="alert alert-success alert-voditelj uspjeh">Uspješno ste dodali novo jelo .</div>
            <?php endif ?>
            <?php if ($z == 2) : ?>
                <div class="alert alert-success alert-voditelj uspjeh">Uspješno ste uredili jelovnik.</div>
            <?php endif ?>

            <table class="table-secondary table-bordered table-hover">
                <tr style="text-align:center">>
                    <th>Broj jela</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Cijena</th>
                    <th>Uredi / Briši</th>
                </tr>

                <?php foreach (Jelo::dajJelo($konekcija) as $jelo) : ?>

                    <tr>
                        <td><?php echo ($jelo["ID"]) ?></td>
                        <td><?php echo ($jelo["naziv"]) ?></td>
                        <td><?php echo ($jelo["opis"]) ?></td>
                        <td><?php echo ($jelo["cijena"]) ?></td>
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

            <button type="button" class="btn btn-secondary add" data-bs-toggle="modal" data-bs-target="#staticBackdropAdd"> Dodaj jelo
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                </svg>
            </button>


            <!-- Modal za dodavanje novog jela -->
            <div class="modal fade" id="staticBackdropAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Dodaj novo jelo</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="voditelj.php">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                </svg></span>
                                        </div>
                                        <input type="text" class="form-control rounded-right input" name="nazivJela" placeholder="Naziv" required>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                </svg></span>
                                        </div>
                                        <input type="text" class="form-control rounded-right input" name="opisJela" placeholder="Opis" required>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                </svg> </span>
                                        </div>
                                        <input type="text" class="form-control rounded-right input" name="cijenaJela" placeholder="Cijena" required>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend input">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <select class="form-select input" name="kategorija" id="kategorija" aria-label="kategorija" required>
                                            <option value=""> Kategorija jela </option>
                                            <?php foreach (KategorijaJela::dajSve() as $kategorija) : ?>
                                                <option value=<?php echo ($kategorija["ID"]) ?>> <?php echo ($kategorija["naziv"]) ?> </option>
                                            <?php endforeach ?>
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

            <!-- Modal za uređivanje jela -->
            <div class="modal fade" id="staticBackdropUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"> Uređivanje jela </h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="voditelj.php">
                                <div class="input-group">
                                    <div class="input-group-prepend input">
                                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ol" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z" />
                                                <path d="M1.713 11.865v-.474H2c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 0 1-.492.594v.033a.615.615 0 0 1 .569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V9H1.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 0 0-.342.338v.041zM2.564 5h-.635V2.924h-.031l-.598.42v-.567l.629-.443h.635V5z" />
                                            </svg></span>
                                    </div>
                                    <input type="text" class="form-control rounded-right input" name="idJela" id="idJela" readonly required>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend input">
                                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                            </svg></span>
                                    </div>
                                    <input type="text" class="form-control rounded-right input" name="nazivJela" id="nazivJela" required placeholder="Naziv">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend input">
                                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                            </svg></span>
                                    </div>
                                    <input type="text" class="form-control rounded-right input" name="opisJela" id="opisJela" required placeholder="Opis">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend input">
                                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                            </svg></span>
                                    </div>
                                    <input type="text" class="form-control rounded-right input" name="cijenaJela" id="cijenaJela" required placeholder="Cijena">
                                </div>

                                <button type="submit" name="update" id="update" class="btn btn-secondary modalButton">Uredi </button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal za brisanje jela -->
            <div class="modal fade" id="staticBackdropDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Brisanje jela</h5>
                        </div>
                        <form method="GET" action="voditelj.php">
                            <div class="modal-body">
                                <p>Jeste li sigurni da želite izbrisati jelo?</p>
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

                $('#idJela').val(data[0]);
                $('#nazivJela').val(data[1]);
                $('#opisJela').val(data[2]);
                $('#cijenaJela').val(data[3]);
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
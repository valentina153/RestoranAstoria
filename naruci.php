<?php
include("model/db.php");
include("model/jelo_class.php");
include("model/kategorijaJela_class.php");
include("model/korisnik_class.php");

$prijavljeni_korisnik = Korisnik::prijavljen();
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

<body class="naruci">
    <?php include('static/navbar.php') ?>

    <div class="jelovnik">
        <img src="menu2.png" width="60px" height="60px">
        <h1>Jelovnik</h1>
    </div>

    <div class="container-fluid">
        <div class="navbar navbar-light navbar-expand-lg">
            <button class="navbar-toggler toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            foreach (KategorijaJela::dajSve() as $kategorija) :
            ?>
                <a class="kategorija collapse navbar-collapse mt-2" id="navbarToggler" href=<?php echo ("#" . $kategorija["naziv"]) ?>><?= $kategorija["naziv"] ?></a>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Doručak">
        <div class="pozadina">
            <img src="dorucak.webp" width="60px" height="60px">
            <h1>Doručak</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Doručak") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Tjestenina">
        <div class="pozadina">
            <img src="tjestenina.png" width="60px" height="60px">
            <h1>Tjestenina i rižoto</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Tjestenina i rižoto") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Starter">
        <div class="pozadina">
            <img src="starter.png" width="60px" height="60px">
            <h1>Starter</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Starter") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Burgeri">
        <div class="pozadina">
            <img src="burgeri.png" width="60px" height="60px">
            <h1>Burgeri</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Burgeri") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Specijal">
        <div class="pozadina">
            <img src="specijal.png" width="60px" height="60px">
            <h1>Specijal</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Specijal") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Tortilje">
        <div class="pozadina">
            <img src="tortilje.png" width="60px" height="60px">
            <h1>Tortilje</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Tortilje") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Pizza">
        <div class="pozadina">
            <img src="pizza.webp" width="60px" height="60px">
            <h1>Pizza</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Pizza") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Kolači">
        <div class="pozadina">
            <img src="kolaci.png" width="60px" height="60px">
            <h1>Kolači</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Kolači") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Palačinke">
        <div class="pozadina">
            <img src="palacinke.webp" width="60px" height="60px">
            <h1>Palačinke</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Palačinke") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="jelo" id="Waffle">
        <div class="pozadina">
            <img src="waffle.png" width="60px" height="60px">
            <h1>Waffle</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach (Jelo::dajKategoriju("Waffle") as $jelo) :
            ?>
                <div class="col-sm-3">

                    <div class="card border-danger bg-light mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jelo["naziv"] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $jelo["cijena"] ?></h6>
                            <p class="card-text"><?= $jelo["opis"] ?></p>
                            <a href="#" class="btn btn-secondary">Naruči</a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>


    <?php include('static/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
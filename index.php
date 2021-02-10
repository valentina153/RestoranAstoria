<?php
session_start();
//if (!isset($_SESSION["token"])) header("Location: login.php");
include("db.php");

if (isset($_SESSION["token"])) $id = $_SESSION["token"];

if (isset($id)) {
    $upit = "SELECT * FROM korisnik WHERE ID=" . $id;
    $rezultat = mysqli_query($konekcija, $upit);
    $prijavljeni_korisnik = mysqli_fetch_assoc($rezultat);
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

<body class="index">
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
                    <a class="nav-link" href="#galerija">Galerija</a>
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

    <div class="naslovnica">
        <div class="container-fluid">
            <div class="jumbotron" id="oRestoranu">
                <p class="naslov">Restoran Astoria</p>
                <br />
                <br />
                <br />
                <p>
                    Bilo da ste u potrazi za kvalitetnim obrokom u vrijeme pauze za ručak
                    ili opuštanjem uz večeru, restoran Astoria je odabir za vas. Jednako
                    privlačan poslovnim ljudima zbog mogućnosti naručivanja hrane
                    unaprijed, obiteljima s djecom i turistima željnima kombinacije okusa
                    vrhunskih specijaliteta, očarat će vas svojim uređenjem te opuštenim
                    gostima, koji se s razlogom uvijek rado vraćaju.<br />
                    Dobrodošli u restoran Astoria!
                </p>
            </div>
        </div>

        <div class="hrana1">
            <img src="hrana01.jpg" width="400px" height="400px" />
            <h1>Hrana je naša strast</h1>
            <p>
                Svakoj namirnici pristupamo s posebnom pažnjom, kako bismo<br />
                kreirali najbolji doživljaj za vaše nepce. Uživajte u šarolikoj
                ponudi<br />
                jela i specijaliteta kuće. Vaše zadovoljstvo, naša je nagrada.
            </p>
        </div>
        <div class="hrana2">
            <img src="hrana02.jpg" width="400px" height="400px" />
            <p>
                Kuharstvo podrazumijeva: englesku temeljitost,<br />
                francusku umjetnost, arapsku gostoljubivost... <br />podrazumijeva
                poznavanje sveg voća, začina, umaka... <br />podrazumijeva pažljivost,
                inventivnost i pozornost.<br /><br />
                <span>- John Ruskin</span>
            </p>
        </div>
        <div class="prijelaz"></div>
        <div class="container" id="galerija">
            <h1>Galerija</h1>
            <br />
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://york.independentlife.co.uk/wp-content/uploads/sites/3/2019/01/12244669_172824903070710_3291839174859070294_o-1024x480.jpg" class="d-block w-100" alt="restoran">
                    </div>
                    <div class="carousel-item">
                        <img src="https://www.eventsource.ca/blog/wp-content/uploads/2017/05/elle-cuisine-header-1024x480.jpg" class="d-block w-100" alt="jelo1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://www.christinis.com/wp-content/uploads/2019/03/bestfinediningorlando-1024x480.jpg" class="d-block w-100" alt="jelo2">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
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
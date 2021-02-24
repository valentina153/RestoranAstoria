<?php
session_start();
include("model/db.php");
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

<body class="index">
    <?php include('static/navbar.php') ?>
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

    <?php include('static/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
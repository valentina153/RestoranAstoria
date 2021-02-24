<?php
require("model/db.php");
include("model/korisnik_class.php");
include("model/rezervacija_class.php");

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

<body>
    <?php include('static/navbar.php') ?>

    <div class="rezervacije">
        <h1>Vaše rezervacije</h1>
    </div>

    <div class="container-fluid pregled">
        <table class="table-secondary table-bordered">
            <tr>
                <th>Broj rezervacije</th>
                <th>Datum</th>
                <th>Broj stola</th>
                <th>Termin</th>
                <th>Vaša napomena</th>
            </tr>
            <?php foreach (Rezervacija::dajRezervaciju($prijavljeni_korisnik["ID"]) as $rezervacija) : ?>
                <tr>
                    <td><?php echo ($rezervacija["ID"]) ?></td>
                    <td><?php
                        $datum = DateTime::createFromFormat('Y-m-d', $rezervacija["datum"]);
                        $datum = $datum->format('d.m.Y');
                        echo ($datum) ?></td>
                    <td><?php echo ($rezervacija["IDStola"]) ?></td>
                    <td><?php echo (Rezervacija::dajTerminID($rezervacija["IDTermina"])) ?></td>
                    <td><?php
                        if ($rezervacija["komentar"] == "") echo ("#");
                        else echo ($rezervacija["komentar"]) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>

    <?php include('static/footer.php') ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
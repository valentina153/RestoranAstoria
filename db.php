<?php

define("RACUNALO", "localhost");
define("KORISNIK", "root");
define("LOZINKA", "");
define("BAZA", "restoran");

$konekcija = mysqli_connect(RACUNALO, KORISNIK, LOZINKA, BAZA);

if(!$konekcija){
    dir("Spajanje na bazu nije uspjelo. Greska: " . mysqli_connect_error());
}

?>
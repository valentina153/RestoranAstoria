<?php
session_start();

class Jelo{

    public static function dajKategoriju ($naziv) {
        global $konekcija;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $upit = "SELECT * FROM jelo WHERE IDKategorije = ( SELECT ID FROM kategorijaJela WHERE naziv =  '$naziv')";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        return $rezultat;
    }
}

?>
<?php

class Stol{

    public static function dajStol() {
        global $konekcija;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $upit = "SELECT * FROM stol";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        return $rezultat;
    }
}

?>
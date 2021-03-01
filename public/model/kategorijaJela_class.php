<?php

class KategorijaJela{

    public static function dajSve () {
        global $konekcija;
        $upit = "SELECT * FROM kategorijaJela";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        return $lista;
    }
}


?>
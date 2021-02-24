<?php

class Korisnik{

    public static function prijavljen () {
        global $konekcija;

        if(isset($_SESSION["token"])) $id = $_SESSION["token"];

        if(isset($id)){
            $upit = "SELECT * FROM korisnik WHERE ID=" . $id;
            $rezultat = mysqli_query($konekcija, $upit);
            $prijavljeni_korisnik = mysqli_fetch_assoc($rezultat);
            return $prijavljeni_korisnik;
        }
        return 0;
    }
}

?>
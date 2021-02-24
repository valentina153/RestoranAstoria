<?php
session_start();

class Rezervacija
{

    public static function dajTermin()
    {
        global $konekcija;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $upit = "SELECT * FROM termin";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        return $rezultat;
    }

    public static function dajRezervaciju($IDKorisnika){
        global $konekcija;
        
        $upit = "SELECT * FROM rezervacija WHERE IDKorisnika = '" . $IDKorisnika . "'";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        return $rezultat;
    }
    public static function dajTerminID($id)
    {
        global $konekcija;
        $upit = "SELECT vrijeme FROM termin WHERE ID = '" . $id . "'";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        foreach ($lista as $l) :
            foreach ($l as $i) :
                return $i;
            endforeach;
        endforeach;
    }

    public static function rezerviraj()
    {
        global $konekcija;
        $datum = $_POST["datum"];
        $komentar = $_POST["komentar"];
        $korisnik = $_SESSION["token"];
        $stol = $_POST["stol"];
        $termin = $_POST["termin"];

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $upit = "INSERT INTO rezervacija (ID, datum, komentar, IDKorisnika, IDStola, IDTermina) VALUES (null, '" . $datum . "', '" . $komentar . "', '" . $korisnik . "', '" . $stol . "', '" . $termin . "');";
        $rezultat = mysqli_query($konekcija, $upit);
        return $rezultat;
    }

    public static function zauzeto()
    {
        global $konekcija;
        $IDStola = $_POST["stol"];
        $datum = $_POST["datum"];
        $IDTermina = $_POST["termin"];

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $upit = "SELECT COUNT(IDStola) FROM rezervacija WHERE IDStola = '" . $IDStola . "' AND datum = '" . $datum . "' AND IDTermina = '" . $IDTermina . "'";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        foreach ($lista as $l) :
            foreach ($l as $i) :
                if ($i > 0) return 1;
                else return 0;
            endforeach;
        endforeach;
    }

    public static function zauzetoSve()
    {
        global $konekcija;
        $datum = $_POST["datum"];

        $upit = "SELECT COUNT(IDStola) FROM rezervacija WHERE datum = '" . $datum . "'";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        foreach ($lista as $l) :
            foreach ($l as $i) :
                if ($i == 70) return 1;
                else return 0;
            endforeach;
        endforeach;
    }

    public static function zauzetTermin()
    {
        global $konekcija;
        $datum = $_POST["datum"];
        $termin = $_POST["termin"];

        $upit = "SELECT COUNT(IDStola) FROM rezervacija WHERE datum = '" . $datum . "' AND IDTermina = '" . $termin . "'";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        foreach ($lista as $l) :
            foreach ($l as $i) :
                if ($i == 14) return 1;
                else return 0;
            endforeach;
        endforeach;
    }
}

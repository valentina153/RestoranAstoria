<?php

class Korisnik
{
    public static function prijavljen()
    {
        global $konekcija;

        if (isset($_SESSION["token"])) $id = $_SESSION["token"];

        if (isset($id)) {
            $upit = "SELECT * FROM korisnik WHERE ID=" . $id;
            $rezultat = mysqli_query($konekcija, $upit);
            $prijavljeni_korisnik = mysqli_fetch_assoc($rezultat);
            return $prijavljeni_korisnik;
        }
        return 0;
    }

    public static function zauzetEmail($email){
        global $konekcija;

        $upit = "SELECT COUNT(*) FROM korisnik WHERE email = '" . $email . "';";
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

    public static function zauzetBroj($broj){
        global $konekcija;

        $upit = "SELECT COUNT(*) FROM korisnik WHERE brojMobitela = '" . $broj . "';";
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

    public static function zauzetEmailUpdate($email, $id){
        global $konekcija;

        $upit = "SELECT COUNT(*) FROM korisnik WHERE email = '" . $email . "' AND ID <> '" . $id . "';";
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

    public static function zauzetBrojUpdate($broj, $id){
        global $konekcija;

        $upit = "SELECT COUNT(*) FROM korisnik WHERE brojMobitela = '" . $broj . "' AND ID <> '" . $id . "';";
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

    public static function dajSve()
    {
        global $konekcija;

        $upit = "SELECT * FROM korisnik";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        return $rezultat;
    }

    public static function dodaj($korisnik)
    {
        global $konekcija;
        $ime = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["imeKorisnika"]));
        $prezime = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["prezimeKorisnika"]));
        $email = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["emailKorisnika"]));
        $broj = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["mobitelKorisnika"]));
        $lozinka = md5($korisnik["lozinkaKorisnika"]);
        $uloga = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["uloga"]));

        $upit = "INSERT INTO korisnik VALUES (null, '" . $ime . "', '" . $prezime . "', '" . $email . "', '" . $broj . "', '" . $lozinka . "', '" . $uloga . "');";
        return mysqli_query($konekcija, $upit);
    }

    public static function uredi($korisnik)
    {
        global $konekcija;
        $id = $korisnik["idKorisnika"];
        $ime = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["imeKorisnika"]));
        $prezime = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["prezimeKorisnika"]));
        $email = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["emailKorisnika"]));
        $broj = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["mobitelKorisnika"]));

        $uloga = htmlspecialchars(mysqli_real_escape_string($konekcija, $korisnik["uloga"]));
        $upit = "UPDATE korisnik SET ime='" . $ime . "', prezime='" . $prezime . "', email='" . $email . "', brojMobitela='" . $broj . "', uloga='" . $uloga . "' WHERE id='" . $id . "';";
        return mysqli_query($konekcija, $upit);
    }

    public static function izbrisi($id){
        global $konekcija;
        $id = intval($id);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
        $upit = "DELETE FROM korisnik WHERE ID = '" . $id . "';";
        return mysqli_query($konekcija, $upit); 
    } 
}

<?php

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

    public static function dajJelo ($naziv) {
        global $konekcija;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $upit = "SELECT * FROM jelo";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        return $rezultat;
    }

    public static function dodaj($jelo)
    {
        global $konekcija;
        $naziv = htmlspecialchars(mysqli_real_escape_string($konekcija, $jelo["nazivJela"]));
        $opis = htmlspecialchars(mysqli_real_escape_string($konekcija, $jelo["opisJela"]));
        $cijena = htmlspecialchars(mysqli_real_escape_string($konekcija, $jelo["cijenaJela"]));
        $kategorija = htmlspecialchars(mysqli_real_escape_string($konekcija, $jelo["kategorija"]));

        $upit = "INSERT INTO jelo VALUES (null, " . "'" . $naziv . "', '" . $opis . "', '" . $cijena . "', '" . $kategorija . "')";
        return mysqli_query($konekcija, $upit);
    }
    


    public static function uredi($jelo)
    {
        global $konekcija;
      
        $id = $jelo["idJela"];
        $naziv = htmlspecialchars(mysqli_real_escape_string($konekcija, $jelo["nazivJela"]));
        $opis = htmlspecialchars(mysqli_real_escape_string($konekcija, $jelo["opisJela"]));
        $cijena = htmlspecialchars(mysqli_real_escape_string($konekcija, $jelo["cijenaJela"]));

        $upit = "UPDATE jelo SET naziv='" . $naziv . "', opis='" . $opis . "', cijena='" . $cijena . "' WHERE id='" . $id . "';";
        return mysqli_query($konekcija, $upit);

    
    }

    public static function izbrisi($id){
        global $konekcija;
        $id = intval($id);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
        $upit = "DELETE FROM jelo WHERE ID = '" . $id. "';";
        return mysqli_query($konekcija, $upit); 
    } 
}



?>
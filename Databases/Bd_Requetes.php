<?php

/**
 * Created by PhpStorm.
 * User: somda
 * Date: 16/07/2018
 * Time: 00:56
 */
class Bd_Requetes
{

    public function __construct(){}

    public static function ListeRequete1($requete){
        $database=new Bd_class();
        //$requete="SELECT * FROM vuelocalite WHERE idlocalite=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function CompterResultat($requet){
        $database=new Bd_class();
        //$requet="SELECT * FROM situer_site_localite WHERE idlocalite=$idlocalite AND idsite=$idsite";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $database->Close();
        return $nbligne;
    }

    public function RecupererNomProjet($id){
        $database=new Bd_class();
        $requet="SELECT * FROM projet WHERE idprojet=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nom=$ligne->nomprojet;
        $database->Close();
        return $nom;
    }

}